<?php
namespace App\Models;

use CodeIgniter\Model;
use Kigkonsult\Icalcreator\Vcalendar;
use Config\Services;

class CatholicCalendarModel extends Model
{
    protected $table = 'catholic_calendar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['summary', 'start', 'end', 'description'];

    public function fetchIcalData()
    {
        $url = 'https://gcatholic.org/calendar/ics/2024-en-KE.ics?v=3';
        $client = Services::curlrequest();
        
        try {
            $response = $client->get($url);
    
            if ($response->getStatusCode() === 200) {
                return $response->getBody();
            }
    
            return null;
        } catch (\Exception $e) {
            log_message('error', 'Error fetching iCal data: ' . $e->getMessage());
            return null;
        }
    }

    public function parseIcalDataAndSave($icalData)
    {
        if (!$icalData) {
            log_message('error', 'No iCal data provided for parsing.');
            return false;
        }

        try {
            // Directly instantiate the Vcalendar object
            $vcalendar = new Vcalendar();
            $vcalendar->parse($icalData); // Parse the iCal data directly

            foreach ($vcalendar->getComponents(Vcalendar::VEVENT) as $component) {
                // Use correct methods for extracting event details
                $start = $component->getDtstart();
                $end = $component->getDtend();

                // Convert DateTime objects to strings
                $startDate = $start instanceof \DateTime ? $start->format('Y-m-d H:i:s') : null;
                $endDate = $end instanceof \DateTime ? $end->format('Y-m-d H:i:s') : null;

                $data = [
                    'summary'     => $component->getSummary(),
                    'start'       => $startDate,
                    'end'         => $endDate,
                    'description' => $component->getDescription(),
                ];

                // Save event to database
                $insertSuccess = $this->insert($data);

                if (!$insertSuccess) {
                    log_message('error', 'Failed to save iCal data to the database: ' . json_encode($data));
                    return false;
                }
            }
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Error parsing iCal data: ' . $e->getMessage());
            return false;
        }
    }
    public function fetchCatholicDays($date = null)
    {
        // If no date is provided, use today's date and format it to 'Y-m-d'
        if (!$date) {
            $date = date('Y-m-d'); // Default to today's date in 'Y-m-d' format
        } else {
            // Ensure the provided date is in 'Y-m-d' format for the database
            $date = (new \DateTime($date))->format('Y-m-d');
        }
    
        // Use the query builder to fetch the summary for the given date
        $builder = $this->builder();
        $builder->select('summary');
        $builder->where('start', $date); // Assuming `start` column stores the date
        $query = $builder->get();
        
        // Return the summary or an appropriate result
        return $query->getRow();
    }
    
}
