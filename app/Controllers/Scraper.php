<?php

namespace App\Controllers;

class Scraper extends BaseController
{
    public function fetchSaintDetails()
    {
        log_message('info', 'Starting fetchAllDetails method');

        // Target URL
        $url = 'https://www.catholic.org/saints/saint.php?saint_id=75';
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

        // Fetch the first image inside the "saintContent" div with ID
        $imageNode = $xpath->query("//div[@id='saintContent']//img")->item(0);
        $imageSrc = $imageNode ? $imageNode->getAttribute('src') : 'No Image Found';

        // Log and store the image data
        log_message('info', 'First image inside saintContent: ' . $imageSrc);

        // Query all <p> tags inside "saintContent" with ID
        $pTags = $xpath->query("//div[@id='saintContent']//p");

        log_message('info', 'Number of <p> tags found inside saintContent: ' . $pTags->length);

        // Store the extracted content in an array
        $scrapedData = [
            'image' => $imageSrc,
            'paragraphs' => []
        ];

        // Check if any <p> tags were found
        if ($pTags->length > 0) {
            foreach ($pTags as $pTag) {
                // Extract the text content of each <p> tag
                $content = trim($pTag->textContent);

                // Log and add the content to the array
                log_message('info', 'Extracted <p> content: ' . $content);
                $scrapedData['paragraphs'][] = $content;
            }
        } else {
            log_message('error', 'No <p> tags found in saintContent.');
            $scrapedData['paragraphs'][] = 'No <p> tags found in saintContent.';
        }

        log_message('info', 'Finished fetchAllDetails method');

        // Return the data as JSON
        return $this->response->setJSON($scrapedData);
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
    
    
    
    
    
    
}
