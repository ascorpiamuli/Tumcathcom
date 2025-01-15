<?php

namespace App\Controllers;

use App\Models\CatholicCalendarModel;

class CatholicCalendarController extends BaseController
{
    public function importCalendar()
    {
        $calendarModel = new CatholicCalendarModel();

        // Fetch iCal data from the URL
        $icalData = $calendarModel->fetchIcalData();

        // Parse and save the iCal data
        if ($icalData) {
            $success = $calendarModel->parseIcalDataAndSave($icalData);

            if ($success) {
                return $this->response->setStatusCode(200)->setBody('iCal data imported and saved successfully!');
            } else {
                return $this->response->setStatusCode(500)->setBody('Failed to save iCal data to the database.');
            }
        } else {
            return $this->response->setStatusCode(500)->setBody('Failed to fetch iCal data.');
        }
    }
}
