<?php

namespace App\Libraries;
use CodeIgniter\Cache\Handlers\FileHandler;

class getServiceRequest
{
    protected $cache;

    // Constructor to inject cache handler
    public function __construct(FileHandler $cache)
    {
        $this->cache = $cache;
    }
    public function fetchReadings($date = null)
    {
        log_message('info', 'Starting fetchReadings method');
        
        // Use the provided date or default to the current date
        $date = $date ?? date('Y-m-d');
        log_message('info', 'Fetching readings for date: ' . $date);
        // Define the cache key for daily readings
        $cacheKey = 'daily_readings_' . $date;

        // Attempt to retrieve cached data
        $cachedData = $this->cache->get($cacheKey);

        if ($cachedData) {
            log_message('info', 'Cache hit for date: ' . $date);
            return $cachedData; // Return cached data if available
        }
        log_message('info', 'Cache miss for date: ' . $date);

        // Target URL with the dynamically provided date
        $url = "https://www.catholic.org/bible/daily_reading/?select_date={$date}";
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
            return [
                'status' => 'error',
                'message' => curl_error($ch),
            ];
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
            'date' => $date,
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
        // Cache the scraped data for future use (e.g., cache for 1 hour)
        $this->cache->save($cacheKey, $scrapedData, 3600); // Cache for 1 hour

        log_message('info', 'Finished fetchReadings method');

        // Return the scraped data
        return $scrapedData;
    }
    public function getDailyPrayers() {
        log_message('info', 'Starting getDailyPrayers method');
        // Use the provided date or default to the current date
        $date = $date ?? date('Y-m-d');
        log_message('info', 'Fetching Prayers for date: ' . $date);
    
        // Define the cache key for daily readings
        $cacheKey = 'daily_prayers_' . $date;
    
        // Attempt to retrieve cached data
        $cachedData = $this->cache->get($cacheKey);
        if ($cachedData) {
            log_message('info', 'Cache hit for date: ' . $date);
            return $cachedData; // Return cached data if available
        }
        log_message('info', 'Cache miss for date: ' . $date);
    
        $url = "https://www.catholic.org/prayers/prayeroftheday/";
        log_message('info', 'Target URL: ' . $url);
    
        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        // Execute cURL request
        $htmlContent = curl_exec($ch);
    
        if (curl_errno($ch)) {
            log_message('error', 'cURL Error: ' . curl_error($ch));
            curl_close($ch);
            return [
                'status' => 'error',
                'message' => curl_error($ch),
            ];
        }
    
        curl_close($ch);
    
        log_message('info', 'Fetched HTML content length: ' . strlen($htmlContent));
        file_put_contents('debug_fetched.html', $htmlContent);
        log_message('info', 'HTML content saved to debug_fetched.html');
    
        // Load the HTML content into DOMDocument
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($htmlContent);
        libxml_clear_errors();
        log_message('info', 'DOMDocument initialized successfully');
    
        // Use DOMXPath to extract the desired content
        $xpath = new \DOMXPath($dom);
        log_message('info', 'DOMXPath initialized successfully');
    
        // Query for <h3> and <p> tags inside the target div
        $tags = $xpath->query("//div[@id='prayersPofd']//h3 | //div[@id='prayersPofd']//p");
    
        log_message('info', 'Number of <h3> and <p> tags found: ' . $tags->length);
    
        // Prepare the output array
        $output = [];
        foreach ($tags as $tag) {
            $output[] = [
                'type' => $tag->nodeName,  // 'h3' or 'p'
                'content' => trim($tag->nodeValue)
            ];
        }
    
        // Cache the output for future requests
        $this->cache->save($cacheKey, $output, 86400); // Cache for 24 hours
        log_message('info', 'Daily prayers cached successfully.');
    
        // Return the data to be used in the view
        return [
            'status' => 'success',
            'data' => $output
        ];
    }
    public function getSaintOfTheDay($date = null)
    {
        log_message('info', 'Starting getSaintOfTheDay method');
    
        // Use the provided date or default to the current date
        $date = $date ?? date('Y-m-d');
        log_message('info', 'Fetching Saint of the Day for date: ' . $date);
    
        // Define the cache key for daily saint
        $cacheKey = 'daily_saint_' . $date;
    
        // Attempt to retrieve cached data
        $cachedData = $this->cache->get($cacheKey);
        if ($cachedData) {
            log_message('info', 'Cache hit for date: ' . $date);
            return $cachedData; // Return cached data if available
        }
        log_message('info', 'Cache miss for date: ' . $date);
    
        $url = "https://www.catholic.org/saints/sofd.php";
        log_message('info', 'Target URL: ' . $url);
    
        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
        // Execute cURL request
        $htmlContent = curl_exec($ch);
    
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            log_message('error', 'cURL Error: ' . $error);
            curl_close($ch);
            return [
                'status' => 'error',
                'message' => $error,
            ];
        }
    
        curl_close($ch);
    
        log_message('info', 'Fetched HTML content of length: ' . strlen($htmlContent));
    
        // Load the HTML content into DOMDocument
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($htmlContent);
        libxml_clear_errors();
        log_message('info', 'DOMDocument initialized and HTML loaded successfully');
    
        // Use DOMXPath to extract the saint name
        $xpath = new \DOMXPath($dom);
        log_message('info', 'DOMXPath initialized successfully');
    
        // Query for the saint name (adjust the XPath based on the actual structure of the HTML)
        $saintNode = $xpath->query("//div[@id='saintsSofd']//h3")->item(0);
        if ($saintNode) {
            $saintName = trim($saintNode->nodeValue);
            log_message('info', 'Saint name extracted: ' . $saintName);
    
            // Cache the saint name for future requests
            $this->cache->save($cacheKey, $saintName, 86400); // Cache for 24 hours
            log_message('info', 'Saint name cached successfully for date: ' . $date);
    
            return [
                'status' => 'success',
                'saint' => $saintName,
            ];
        } else {
            log_message('warning', 'No saint name found in the fetched content.');
            return [
                'status' => 'error',
                'message' => 'No saint name found.',
            ];
        }
    }
    
}

