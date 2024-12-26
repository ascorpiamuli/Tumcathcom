<?php

namespace App\Controllers;


class Scraper extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function fetchAndSaveSaints()
    {
        // Increase the maximum execution time for this script
        ini_set('max_execution_time', 3000); // Set it to 5 minutes
    
        $saintModel = new \App\Models\SaintsModel();
        $maxSaints = 1000;
        $batchSize = 10; // Number of saints to process at a time
    
        // Loop through saints
        for ($saintId =755; $saintId <= $maxSaints; $saintId++) {
            // Process in batches
            if ($saintId % $batchSize == 0) {
                // Sleep to avoid overloading the server (adjust as needed)
                sleep(2); 
            }
    
            // Construct URL dynamically
            $url = "https://www.catholic.org/saints/saint.php?saint_id=" . $saintId;
    
            // Fetch saint details
            $saintData = $this->fetchSaintDetails($url, $saintId);
    
            if ($saintData) {
                // Check if the saint already exists
                if (!$saintModel->where('saint_id', $saintId)->first()) {
                    // Save saint details to the database
                    $saintModel->insert($saintData);
                    log_message('info', "Saved Saint ID $saintId: " . $saintData['title']);
                } else {
                    log_message('info', "Saint ID $saintId already exists. Skipping...");
                }
            }
        }
    
        echo "Finished fetching and saving all saints!";
    }
    
    
    private function fetchSaintDetails($url, $saintId)
    {
        // Initialize cURL session
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        // Set cURL timeout to prevent hanging requests
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); // 30 seconds timeout for each request
    
        $htmlContent = curl_exec($ch);
    
        if (curl_errno($ch)) {
            log_message('error', "cURL Error for Saint ID $saintId: " . curl_error($ch));
            curl_close($ch);
            return null;
        }
    
        curl_close($ch);
    
        // Parse the HTML using DOMDocument and XPath
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        @$dom->loadHTML($htmlContent);
        $xpath = new \DOMXPath($dom);
        libxml_clear_errors();
    
        // Extract details
        $titleNode = $xpath->query("//div[@id='content']//h1")->item(0);
        $title = $titleNode ? trim($titleNode->textContent) : null;
    
        $youtubeNodes = $xpath->query("//div[@class='youtubeSpeed']//a");
        $youtubeLinks = [];
        foreach ($youtubeNodes as $node) {
            $youtubeLinks[] = $node->getAttribute('href');
        }
    
        // Extract feast day, patron, birth, and death
        $detailsNode = $xpath->query("//div[@class='panel-body']")->item(0);
        $details = $detailsNode ? $detailsNode->textContent : null;
    
        $feastDay = null;
        $patron = null;
        $birth = null;
        $death = null;
    
        if ($details) {
            preg_match('/Feastday:\s*([^\n]+)/', $details, $feastDayMatch);
            preg_match('/Patron:\s*([^\n]+)/', $details, $patronMatch);
            preg_match('/Birth:\s*(\d+)/', $details, $birthMatch);
            preg_match('/Death:\s*(\d+)/', $details, $deathMatch);
    
            $feastDay = $feastDayMatch[1] ?? null;
            $patron = $patronMatch[1] ?? null;
            $birth = $birthMatch[1] ?? null;
            $death = $deathMatch[1] ?? null;
        }
    
        $imageNode = $xpath->query("//div[@id='saintContent']//img")->item(0);
        $saintImage = $imageNode ? $imageNode->getAttribute('src') : null;
    
        $paragraphNodes = $xpath->query("//div[@id='saintContent']//p");
        $paragraphs = [];
        foreach ($paragraphNodes as $node) {
            $paragraphs[] = trim($node->textContent);
        }
    
        // Return extracted data
        return [
            'saint_id' => $saintId,
            'title' => $title,
            'feast_day' => $feastDay,
            'patron' => $patron,
            'birth' => $birth,
            'death' => $death,
            'saint_image' => $saintImage,
            'paragraphs' => json_encode($paragraphs),
            'youtube_links' => json_encode($youtubeLinks),
        ];
    }

    
    

    
    public function fetchReadings()
    {
        log_message('info', 'Starting fetchReadings method');
    
        // Target URL
        $url = 'https://www.catholic.org/bible/daily_reading/?select_date=2024-12-18';
        log_message('info', 'Target URL: ' . $url);
    
        // Initialize cURL session
        $ch = curl_init();
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        // Execute cURL request
        $htmlContent = curl_exec($ch);
    
        // Check for errors
        if (curl_errno($ch)) {
            log_message('error', 'cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return;
        }
    
        // Close cURL session
        curl_close($ch);
    
        log_message('info', 'Fetched HTML content length: ' . strlen($htmlContent));
    
        // Save HTML content for debugging
        file_put_contents('debug_fetched.html', $htmlContent);
        log_message('info', 'HTML content saved to debug_fetched.html');
    
        // Load the HTML content into DOMDocument
        libxml_use_internal_errors(true); // Suppress DOM parsing warnings
        $dom = new \DOMDocument();
        $dom->loadHTML($htmlContent);
        libxml_clear_errors();
        log_message('info', 'DOMDocument initialized successfully');
    
        // Use DOMXPath to extract the desired content
        $xpath = new \DOMXPath($dom);
        log_message('info', 'DOMXPath initialized successfully');
    
        // Query all <h3> and <p> tags inside the div with id="bibleDailyReading"
        $tags = $xpath->query("//div[@id='bibleDailyReading']//h3 | //div[@id='bibleDailyReading']//p");
    
        log_message('info', 'Number of <h3> and <p> tags found inside bibleDailyReading: ' . $tags->length);
    
        // Store the extracted content in an array
        $scrapedData = [
            'content' => []
        ];
    
        // Check if any <h3> or <p> tags were found
        if ($tags->length > 0) {
            $currentTopic = '';
            $currentParagraphs = [];
    
            foreach ($tags as $tag) {
                if ($tag->nodeName == 'h3') {
                    // If there is an existing topic with paragraphs, add it to the content array
                    if (!empty($currentParagraphs)) {
                        $scrapedData['content'][] = [
                            'topic' => $currentTopic,
                            'paragraphs' => $currentParagraphs
                        ];
                    }
    
                    // Set the current topic
                    $currentTopic = trim($tag->textContent);
                    log_message('info', 'Extracted topic: ' . $currentTopic);
                    // Reset paragraphs for the new topic
                    $currentParagraphs = [];
                } elseif ($tag->nodeName == 'p') {
                    // Add non-empty paragraphs under the current topic
                    $paragraphContent = trim($tag->textContent);
                    if (!empty($paragraphContent)) {
                        $currentParagraphs[] = $paragraphContent;
                        log_message('info', 'Extracted paragraph: ' . $paragraphContent);
                    }
                }
            }
    
            // Add the last topic if it has paragraphs
            if (!empty($currentParagraphs)) {
                $scrapedData['content'][] = [
                    'topic' => $currentTopic,
                    'paragraphs' => $currentParagraphs
                ];
            }
    
        } else {
            log_message('error', 'No <h3> or <p> tags found inside bibleDailyReading.');
            $scrapedData['content'][] = 'No <h3> or <p> tags found inside bibleDailyReading.';
        }
    
        log_message('info', 'Finished fetchReadings method');
    
        // Return the data as JSON
        return $this->response->setJSON($scrapedData);
    }
    public function fetchPrayers()
    {
        log_message('info', 'Starting fetchPrayers method');
        
        // Loop through pages 1 to 900
        for ($i = 313; $i <= 900; $i++) {
            try {
                // Dynamically reset execution time
                set_time_limit(60); // Set max execution time for each iteration
                
                // Dynamic URL with changing page number
                $url = 'https://www.catholic.org/prayers/prayer.php?p=' . $i;
                log_message('info', 'Fetching prayers from URL: ' . $url);
                
                // Initialize cURL session
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                
                // Execute cURL request
                $htmlContent = curl_exec($ch);
                
                // Check for cURL errors
                if (curl_errno($ch)) {
                    log_message('error', 'cURL Error on page ' . $i . ': ' . curl_error($ch));
                    curl_close($ch);
                    continue; // Skip to next iteration
                }
                
                // Close cURL session
                curl_close($ch);
                
                log_message('info', 'Fetched HTML content length: ' . strlen($htmlContent));
                
                // Load the HTML content into DOMDocument
                libxml_use_internal_errors(true); // Suppress DOM parsing warnings
                $dom = new \DOMDocument();
                $dom->loadHTML($htmlContent);
                libxml_clear_errors();
                log_message('info', 'DOMDocument initialized successfully');
                
                // Use DOMXPath to extract the desired content
                $xpath = new \DOMXPath($dom);
                log_message('info', 'DOMXPath initialized successfully');
                
                // Fetch the title (h1) inside the #content div
                $h1Tags = $xpath->query("//div[@id='content']//h1");
                $title = $h1Tags->length > 0 ? trim($h1Tags->item(0)->textContent) : 'Unknown Title';
                log_message('info', 'Extracted title: ' . $title);
                
                // Fetch the prayer content from the divs with class col-sm-12 inside #content
                $contentDivs = $xpath->query("//div[@id='content']//div[@class='col-sm-12']");
                $prayersContent = [];
                
                if ($contentDivs->length > 0) {
                    foreach ($contentDivs as $div) {
                        // Extract and clean the content
                        $divHtmlContent = $dom->saveHTML($div);
                        $divHtmlContent = preg_replace('/<script.*?<\/script>/is', '', $divHtmlContent);
                        $divHtmlContent = preg_replace('/<!--.*?-->/s', '', $divHtmlContent);
                        $divHtmlContent = strip_tags($divHtmlContent, "<br>\n");
                        $divHtmlContent = preg_replace('/<br\s*\/?>/', "\n", $divHtmlContent);
                        $divHtmlContent = trim(preg_replace('/[\r\n]+/', "\n", $divHtmlContent));
                        
                        // Stop at the first "Amen"
                        $divHtmlContent = substr($divHtmlContent, 0, strpos($divHtmlContent, 'Amen') + strlen('Amen'));
                        
                        // Skip if content is less than 10 words or more than 500 words
                        if (str_word_count($divHtmlContent) < 10 || str_word_count($divHtmlContent) > 500) {
                            continue;
                        }
                        
                        $prayersContent[] = $divHtmlContent;
                    }
                }
                
                // Save to the database if there is valid content
                if (!empty($prayersContent)) {
                    foreach ($prayersContent as $prayer) {
                        $this->savePrayersToDatabase([
                            'title' => $title,
                            'content' => $prayer
                        ]);
                    }
                }
                
            } catch (\Throwable $e) {
                // Log the error and continue to the next iteration
                log_message('error', 'Error on page ' . $i . ': ' . $e->getMessage());
            }
        }
    }
    
    private function savePrayersToDatabase($data)
    {
        $prayerModel = new \App\Models\PrayerModel();
        $prayerModel->save($data);
    }
    public function saveMysteriesOfTheRosary() {
        $baseUrl = "https://www.catholic.org/prayers/mystery.php?id=";
        $daysMapping = [
            1 => 'Monday & Saturday',
            2 => 'Tuesday & Friday',
            3 => 'Wednesday & Sunday',
            4 => 'Thursday'
        ];
    
        log_message('info', 'Starting saveMysteriesOfTheRosary method');
    
        // Loop through each day (ID 1 to 4)
        for ($id = 1; $id <= 4; $id++) {
            $url = $baseUrl . $id;
            log_message('info', "Fetching data for ID: $id, URL: $url");
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $htmlContent = curl_exec($ch);
    
            if (curl_errno($ch)) {
                log_message('error', 'cURL Error for ID: ' . $id . ', Error: ' . curl_error($ch));
                curl_close($ch);
                continue;
            }
            curl_close($ch);
            log_message('info', "Successfully fetched HTML content for ID: $id");
    
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHTML($htmlContent);
            libxml_clear_errors();
    
            $xpath = new \DOMXPath($dom);
    
            // Main Title (this is the general title for the day, like "Joyful Mysteries")
            $titleNode = $xpath->query("//div[@id='content']//h1");
            $mainTitle = $titleNode->length > 0 ? trim($titleNode->item(0)->nodeValue) : null;
    
            if (!$mainTitle) {
                log_message('error', "Failed to fetch main title for ID: $id");
                continue;
            }
            log_message('info', "Fetched main title: $mainTitle for ID: $id");
    
            // Get the mysteries (h3 and h4 elements)
            $mysteryTitles = $xpath->query("//div[@id='prayersMysteryRosary']//div[@id='contentMystery']//h3");
            $mysteryNumbers = $xpath->query("//div[@id='prayersMysteryRosary']//div[@id='contentMystery']//h4");
            $paragraphs = $xpath->query("//div[@id='prayersMysteryRosary']//div[@id='contentMystery']//p");
    
            $currentIndex = 0;
            for ($index = 0; $index < 5; $index++) { // Process the first 5 mysteries
                if ($index >= $mysteryTitles->length || $index >= $mysteryNumbers->length) {
                    break;
                }
    
                // Get mystery title and number
                $mysteryTitle = trim($mysteryTitles->item($index)->nodeValue);
                $mysteryNumber = trim($mysteryNumbers->item($index)->nodeValue);
    
                if (!$mysteryTitle || !$mysteryNumber) {
                    log_message('error', "Missing title or number for ID: $id, Mystery Index: $index");
                    continue;
                }
    
                // Get content (p element for the current mystery)
                $mysteryContent = '';
                $paragraph = $paragraphs->item($index);
                if ($paragraph) {
                    $mysteryContent = trim($paragraph->nodeValue);
                }
    
                if (!$mysteryContent) {
                    log_message('error', "No content for Mystery: $mysteryTitle, Number: $mysteryNumber");
                    continue;
                }
    
                log_message('info', "Fetched Mystery Title: $mysteryTitle, Number: $mysteryNumber, Content length: " . strlen($mysteryContent) . " for ID: $id");
    
                // Save the mystery to the database
                $data = [
                    'day'             => $daysMapping[$id],
                    'title'           => $mainTitle,
                    'mystery_title'   => $mysteryTitle,
                    'mystery_number'  => $mysteryNumber,
                    'mystery_content' => $mysteryContent,
                    'created_at'      => date('Y-m-d H:i:s'),
                    'updated_at'      => date('Y-m-d H:i:s'),
                ];
    
                try {
                    $builder = $this->db->table('mysteries_of_the_rosary');
                    $builder->insert($data);
    
                    log_message('info', "Data for ID: $id, Mystery Index: $index inserted successfully.");
                } catch (\Exception $e) {
                    log_message('critical', "Error inserting data for ID: $id, Mystery Index: $index - " . $e->getMessage());
                }
            }
        }
    
        log_message('info', "Finished saving mysteries of the Rosary.");
    }
    
    
    
    
    

    
    
    
    
    
    
    
}
