<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SuggestionsModel;

class SuggestionsController extends BaseController
{
    public $suggestionsModel;

    public function __construct()
    {
        $this->suggestionsModel = new SuggestionsModel();
    }

    public function index()
    {
        // Fetch suggestions
        $suggestions = $this->suggestionsModel->getAllSuggestions();
    }

    public function submitSuggestion()
    {
        $session = session();
        $userId = $session->get('user_id'); // Assuming user is logged in
        $adminId = $session->get('admin_id');
        $message = $this->request->getPost('message');

        if (!$message) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Message is required']);
        }

        if (!$userId && !$adminId) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User not authenticated']);
        }

        // Determine which ID to use
        $insertUserId = $adminId ?: $userId;

        // Insert into database
        $this->suggestionsModel->insert([
            'user_id' => $insertUserId,
            'message' => $message
        ]);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Suggestion submitted!']);
    }

    public function fetchSuggestions()
    {
        $suggestions = $this->suggestionsModel->getAllSuggestions();

        return $this->response->setJSON($suggestions ?: []);
    }
}
