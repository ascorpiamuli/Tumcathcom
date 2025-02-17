<?php

namespace App\Traits;

use App\Models\AnnouncementsModel;

trait AnnouncementsTrait
{
    protected $announcementsModel;

    public function getLatestAnnouncement()
    {
        $data = $this->getCommonData('Announcements');
        $session = session();
        $adminId = $session->get('admin_id');
        
        // Get the latest announcement for display
        $announcement = $this->announcementsModel->getAnnouncements();
        

        // Get the latest announcement (most recent)
        $latestAnnouncement = end($announcement);

        // Check if the announcement is older than 3 days
        $currentDate = new \DateTime();
        $createdAt = new \DateTime($latestAnnouncement['created_at']);
        $diff = $currentDate->diff($createdAt);

        // Determine if the modal should be shown (for admin or any user)
        $showModal = ($diff->days <= 3) ? true : false;

        // Pass the announcement and modal flag to the view
        return view('/layouts/main', array_merge($data, [
            'announcement' => $latestAnnouncement, // Pass announcement data to everyone
            'showModal' => $showModal
        ]));
    }
}
