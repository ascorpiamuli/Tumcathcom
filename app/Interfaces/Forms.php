<?php
namespace App\Interfaces;

interface Forms
{
    /**
     * Store form data in the database.
     * 
     * @param string $registrationType
     * @return bool
     */
    public function storeFormData($registrationType,$session);

    /**
     * Handles form submission
     * 
     * @param array $formData
     * @return bool
     */
    public function submitFormData($registrationType, $session, $model);

    /**
     * Registration data for the semester
     * @param none
     * @return array
     */
    public function submitRegistrationData();

    /**
     * Submit all assets data.
     * 
     * @param string $registrationType
     * @return array
     */
    public function submitAssetData($assetsData, $logger);
        /**
     * Submit all update profile data.
     * 
     * @param  $session
     * @return array
     */
    public function submitProfileData($session);
}
