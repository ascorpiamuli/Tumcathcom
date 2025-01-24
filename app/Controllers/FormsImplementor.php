<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class FormsImplementor
 *
 * FormsImplementor provides a convenient place for loading Form related Logic
 * and performing functions that are needed by all your Forms.
 *     class Home extends BaseController
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class FormsImplementor extends BaseController
{
    // Private function to store form data submission
    protected function storeFormData($registrationType,$session)
    {
        // Define the first form data array (Step 1)
        $formData = [
            'name' => $this->request->getPost('yourname'),
            'phone' => $this->request->getPost('yourphone'),
            'guardian_name' => $this->request->getPost('guardianname'),
            'guardian_phone' => $this->request->getPost('guardianphone'),
            'gender' => $this->request->getPost('gender'),
            'home_diocese' => $this->request->getPost('diocese'),
            'home_parish' => $this->request->getPost('parish'),
            'academic_progression_status' => $this->request->getPost('progression'),
            'family_jumuia' => $this->request->getPost('family'),
            'semester_period' => $this->request->getPost('semesterperiod'),
            'created_at' => date('Y-m-d H:i:s'), // Current timestamp
            'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
        ];

        // Define the second form data array (Step 2)
        $formData2 = [
            'name' => $this->request->getPost('yourname'),
            'phone' => $this->request->getPost('yourphone'),
            'guardian_name' => $this->request->getPost('guardianname'),
            'guardian_phone' => $this->request->getPost('guardianphone'),
            'baptismal_name' => $this->request->getPost('baptismalname'),
            'gender' => $this->request->getPost('gender'),
            'home_diocese' => $this->request->getPost('diocese'),
            'home_parish' => $this->request->getPost('parish'),
            'academic_progression_status' => $this->request->getPost('progression'),
            'family_jumuia' => $this->request->getPost('family'),
            'semester_period' => $this->request->getPost('semesterperiod'),
            'baptismal_certificate' => '', // Will be updated if upload is successful
            'created_at' => date('Y-m-d H:i:s'), // Current timestamp
            'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
        ];

        // Define the third form data array (Step 3)
        $formData3 = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
            'academic_progression_status' => $this->request->getPost('progression'),
            'family_jumuia' => $this->request->getPost('family'),
            'semester_period' => $this->request->getPost('semesterperiod'),
            'created_at' => date('Y-m-d H:i:s'), // Current timestamp
            'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
        ];

        // Define the fourth form data array (Step 4)
        $formData4 = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'gender' => $this->request->getPost('gender'),
            'academic_progression_status' => $this->request->getPost('progression'),
            'family_jumuia' => $this->request->getPost('family'),
            'semester_period' => $this->request->getPost('semesterperiod'),
            'created_at' => date('Y-m-d H:i:s'), // Current timestamp
            'updated_at' => date('Y-m-d H:i:s'), // Current timestamp
        ];

        // Return the form data based on registration type (step)
        switch ($registrationType) {
            case 'step1':
                return $formData;
            case 'step2':
                return $formData2;
            case 'step3':
                return $formData3;
            case 'step4':
                return $formData4;
            default:
                return null; // If the registration type is invalid
        }
    }

    protected function submitStep1FormData($registrationType,$session)
    {
        // Validation rules with custom error messages
        $validationRules= get_validation_rules($registrationType);
        // Custom error messages
        $errorMessages= get_error_messages($registrationType);
        // Run validation with custom error messages
        if (!$this->validate($validationRules, $errorMessages)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        // Custom validation: Ensure phone numbers don't match
        $yourphone = $this->request->getPost('yourphone');
        $guardianphone = $this->request->getPost('guardianphone');
        if ($yourphone === $guardianphone) {
            $session->setFlashdata('error', 'Your phone number and guardian\'s phone number should not match.');
            return redirect()->back()->withInput();
        }
        $formData=$this->storeFormData($registrationType,$session);
        if ($this->liturgicalCatechistModel->saveData($formData)) {
            $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
        } else {
            $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
        }
        log_message('info', 'Form submitted: ' . json_encode($formData));
    }
    protected function submitStep2FormData($registrationType,$session)
    {
        // Validation rules with custom error messages
        $validationRules= get_validation_rules($registrationType);
        // Custom error messages
        $errorMessages= get_error_messages($registrationType);
        // Run validation with custom error messages
        if (!$this->validate($validationRules, $errorMessages)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        // Custom validation: Ensure phone numbers don't match
        $yourphone = $this->request->getPost('yourphone');
        $guardianphone = $this->request->getPost('guardianphone');
        if ($yourphone === $guardianphone) {
            $session->setFlashdata('error', 'Your phone number and guardian\'s phone number should not match.');
            return redirect()->back()->withInput();
        }
        $formData=$this->storeFormData($registrationType,$session);
        if ($this->liturgicalClassesModel->saveData($formData)) {
            $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
        } else {
            $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
        }
        // Handle file upload
        $file = $this->request->getFile('baptismal_certificate');
        try {
            if ($file->isValid() && !$file->hasMoved()) {
                $uploadPath = WRITEPATH . 'uploads/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $file->move($uploadPath);
                $formData['baptismal_certificate'] = $file->getName();
            }
        } catch (\Exception $e) {
            log_message('error', 'File upload failed: ' . $e->getMessage());
            $session->setFlashdata('error', 'File upload failed. Please try again.');
            return redirect()->back()->withInput();
        }
        if ($this->liturgicalClassesModel->saveData($formData)) {
            $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
        } else {
            $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
        }

        log_message('info', 'Form submitted: ' . json_encode($formData));

    }
    protected function submitStep3FormData($registrationType,$session){
        // Validation rules with custom error messages
        $validationRules= get_validation_rules($registrationType);
        // Custom error messages
        $errorMessages= get_error_messages($registrationType);
        // Run validation with custom error messages
        if (!$this->validate($validationRules, $errorMessages)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }
        $formData=$this->storeFormData($registrationType,$session);
        if ($this->liturgicalServersModel->saveData($formData)) {
            $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
        } else {
            $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
        }

        log_message('info', 'Form submitted: ' . json_encode($formData));
    }
    protected function submitStep4FormData($registrationType, $session)
    {
        // Validation rules with custom error messages
        $validationRules = get_validation_rules($registrationType);
        // Custom error messages
        $errorMessages = get_error_messages($registrationType);

        // Run validation with custom error messages
        if (!$this->validate($validationRules, $errorMessages)) {
            $session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        // Get the form data
        $formData = $this->storeFormData($registrationType, $session);

        // Check if $formData is valid
        if ($formData === null) {
            $session->setFlashdata('error', 'Invalid form data.');
            return redirect()->back();
        }

        // Log the form data
        log_message('debug', print_r($formData, true));

        // Save data to the model
        if ($this->liturgicalDancersModel->saveData($formData)) {
            $session->setFlashdata('success', 'Registration successful! Await approval by the Liturgical Coordinator.');
        } else {
            $session->setFlashdata('error', 'Failed to save registration details. Please try again.');
        }

        // Log after form submission
        log_message('info', 'Form submitted: ' . json_encode($formData));
    }
    protected function submitRegistrationData(){

            $phoneNumber = $this->request->getPost('phone');
            $amount = $this->request->getPost('amount');   
            $name = $this->request->getPost('name');
            $progression = $this->request->getPost('progression');  
            $semesterperiod = $this->request->getPost('semesterperiod');  
            $family = $this->request->getPost('family'); 
    
            // Validate phone number and amount
            $isValidPhoneNumber = preg_match('/^254(7|1)\d{8}$/', $phoneNumber) || preg_match('/^0(7|1)\d{8}$/', $phoneNumber);
            $isValidAmount = $amount >= 50;
            
            if (!$isValidAmount) {
                session()->setFlashdata('info', 'Amount should not be less than 50 shillings.');
                return redirect()->back()->withInput();
            }
            
            // Check if phone number starts with '7' or '1' and has 9 digits
            if (preg_match('/^(7|1)\d{8}$/', $phoneNumber)) {
                $phoneNumber = '254' . $phoneNumber;
            } elseif (!preg_match('/^254(7|1)\d{8}$/', $phoneNumber) && !preg_match('/^0(7|1)\d{8}$/', $phoneNumber)) {
                // If phone number is invalid, set flashdata with error
                session()->setFlashdata('error', 'Invalid phone number. Please enter a valid phone number.');
                return redirect()->back()->withInput();
            }
            
    
            // Proceed with the M-Pesa transaction
            try {
                $mpesaInit = new \App\Libraries\Mpesa;
                $mpesaInit->lipa_na_mpesa($phoneNumber, $amount);
                $registrationData = [
                    'name' => $name,
                    'phone_number' => $phoneNumber,
                    'amount' => $amount,
                    'progression' => $progression,
                    'semester_period' => $semesterperiod,
                    'family' => $family,
                    'created_at' => date('Y-m-d H:i:s'), // Add a timestamp if needed
                ];
                $this->semesterRegistrationModel->save($registrationData);
            } catch (\Exception $e) {
                // Log any errors that occur during the transaction
                log_message('error', 'Error initiating M-Pesa transaction: ' . $e->getMessage());
                $session = session();
                $session->setFlashdata('error', 'There was an error initiating the M-Pesa transaction.');
            }

    }
    protected function submitAssetData($assetsData,$logger){
        // Get other form data
        $phone = $this->request->getPost('phone');
        $family = $this->request->getPost('family');
        $bookingid = $this->request->getPost('booking_id');
        $comments = $this->request->getPost('comments');
        $bookedBy = $this->request->getPost('booked_by');
        $location = $this->request->getPost('location');
        $hireDateTime = $this->request->getPost('hireDateTime');
        $returnDateTime = $this->request->getPost('returnDateTime');

        // Define validation rules  and messages for common fields
        $validationRules =get_validation_rules("assetscommon");
        $validationMessages =get_error_messages("assetscommon");

        // Validate common fields
        if (!$this->validate($validationRules, $validationMessages)) {
            $errors = $this->validator->getErrors();
            $logger->error('Validation failed for common fields.', $errors);
            session()->setFlashdata('errors', $errors);
            return redirect()->back()->withInput();
        }

        // Validate comments
        if (!empty($comments) && str_word_count($comments) > 40) {
            $errors['comments'] = 'Comments cannot exceed 40 words.';
            session()->setFlashdata('errors', $errors);
            return redirect()->back()->withInput();
        }

        // Initialize an array to collect errors for assets
        $assetErrors = [];
        $hasValidationErrors = false;
        // Process the received assets data here
        foreach ($assetsData as $key => $asset) {
            log_message('debug', "Processing Asset #$key: " . json_encode($asset));

            // Ensure asset data is not empty
            if (empty($asset['assetname']) || empty($asset['category']) || empty($asset['condition']) || empty($asset['status']) || empty($asset['value']) || empty($asset['quantity'])) {
                log_message('error', "Asset #$key has missing fields: " . json_encode($asset));
            }

            // Define validation rules for each asset
            $assetValidationRules =get_validation_rules("assets");

            $assetValidationMessages = get_error_messages("assets");

            // Add custom validation rules for status and condition
            if ($asset['status'] === 'Unavailable') {
                $assetValidationMessages['status']['custom_error'] = 'You cannot book an "Unavailable" Asset. It is on Hire';
            }

            if ($asset['condition'] === 'Poor') {
                $assetValidationMessages['condition']['custom_error'] = 'You cannot be assigned a "Poor" condition Asset.';
            }

            // Explicitly pass asset data to the validate method as an array
            $validation = \Config\Services::validation();
            $validation->setRules($assetValidationRules, $assetValidationMessages);

            // Log validation data for debugging
            log_message('debug', "Validating Asset #$key: " . json_encode($asset));

            // Validate asset data
            if (!$validation->run($asset)) {
                $assetErrors[$key] = $validation->getErrors();
                $hasValidationErrors = true;

                // Log validation errors for the asset
                log_message('error', "Validation failed for Asset #$key: " . json_encode($assetErrors[$key]));
            }

            // Prepare data for insertion if no errors
            if (!isset($assetErrors[$key])) {
                // Check if the asset already exists for this booking_id and assetname
                $existingAsset = $this->assetsModel->where('booking_id', $bookingid)
                                                ->where('name', $asset['assetname'])
                                                ->first();

                if ($existingAsset) {
                    // If asset already exists, update the quantity or any other fields if necessary
                    log_message('info', "Asset #$key already exists for booking_id $bookingid. Updating the existing record.");

                    // For example, update the quantity (or other fields as needed)
                    $updatedData = [
                        'quantity' => $existingAsset['quantity'] + $asset['quantity'], // Increment quantity
                        'value' => $asset['value'], // Update value, you could handle other fields as well
                    ];

                    // Log the update operation
                    log_message('debug', "Updating Asset #$key in database: " . json_encode($updatedData));

                    // Update the existing asset record
                    $this->assetsModel->update($existingAsset['id'], $updatedData);
                } else {
                    // If asset does not exist, insert it as a new asset
                    $data = [
                        'booking_id' => $bookingid,
                        'phone' => $phone,
                        'family' => $family,
                        'comments' => $comments,
                        'booked_by' => $bookedBy, 
                        'location' => $location,
                        'booking_start_date' => $hireDateTime,
                        'booking_end_date' => $returnDateTime, 
                        'name' => $asset['assetname'], 
                        'category' => $asset['category'],
                        'asset_condition' => $asset['condition'],
                        'status' => $asset['status'],
                        'value' => $asset['value'],
                        'quantity' => $asset['quantity'],
                    ];

                    // Log data being inserted
                    log_message('debug', "Inserting Asset #$key into database: " . json_encode($data));

                    // Insert data into the database
                    $this->assetsModel->insert($data);

                    // Log successful insertion
                    log_message('info', "Asset #$key successfully inserted into the database.");
                }
            }
        }
        // If there are validation errors, set them in flashdata and return
        if ($hasValidationErrors) {
           // session()->setFlashdata('assetErrors', $assetErrors);
            session()->setFlashdata('error', 'Fill all the Required Fields.');
            log_message('error', 'Validation errors occurred during asset processing.');
            return redirect()->back()->withInput();
        }else{
        // Set success message if no errors occurred
        session()->setFlashdata('success', 'Booked successfully.Wait For approval by the Assets Manager.Communication will be Made Within 24 Hours');
        log_message('info', 'All assets processed and saved successfully.');
        }
    }

}
