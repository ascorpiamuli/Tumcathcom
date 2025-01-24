<?php
if (!function_exists('get_validation_rules')) {
    function get_validation_rules($step)
    {
        switch ($step) {
            case 'step1':
                return [
                    'yourname' => 'required',
                    'yourphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'guardianname' => 'required',
                    'guardianphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'gender' => 'required',
                    'diocese' => 'required',
                    'parish' => 'required',
                    'progression' => 'required',
                    'family' => 'required',
                    'semesterperiod' => 'required',
                ];
            case 'step2':
                return [
                    'yourname' => 'required',
                    'yourphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'guardianname' => 'required',
                    'guardianphone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'baptismalname' => 'required',
                    'gender' => 'required',
                    'diocese' => 'required',
                    'parish' => 'required',
                    'progression' => 'required',
                    'family' => 'required',
                    'semesterperiod' => 'required',
                    'baptismal_certificate' => 'uploaded[baptismal_certificate]|max_size[baptismal_certificate,1024]|ext_in[baptismal_certificate,pdf]',
                ];
            case 'step3':
                return [
                    'name' => 'required',
                    'phone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'gender' => 'required',
                    'progression' => 'required',
                    'family' => 'required',
                    'semesterperiod' => 'required',
                ];
            case 'step4':
                return [
                    'name' => 'required',
                    'phone' => 'required|numeric|min_length[9]|max_length[9]|regex_match[/^7\d{8}$/]',
                    'gender' => 'required',
                    'progression' => 'required',
                    'family' => 'required',
                    'semesterperiod' => 'required',
                ];
            case 'assetscommon':
                return[
                    'booked_by' => 'required',
                    'location' => 'required',
                    'hireDateTime' => 'required',
                    'returnDateTime' => 'required',
                ];
            case 'assets':
                return [
                    'assetname' => 'required', 
                    'category' => 'required',
                    'condition' => 'required',
                    'status' => 'required',
                    'value' => 'required',
                    'quantity' => 'required',
                ];
            default:
                return [];
        }
    }
}

if (!function_exists('get_error_messages')) {
    function get_error_messages($step)
    {
        switch ($step) {
            case 'step1':
                return [
                    'yourname' => 'Please enter your full name.',
                    'yourphone' => [
                        'required' => 'Your phone number is required.',
                        'numeric' => 'Your phone number must contain only digits.',
                        'min_length' => 'Your phone number must be 9 digits long.',
                        'max_length' => 'Your phone number must be exactly 9 digits long.',
                        'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                    ],
                    // Add similar error messages for other fields
                ];
            case 'step2':
                return [
                    'yourname' => 'Please enter your full name.',
                    'yourphone' => [
                        'required' => 'Your phone number is required.',
                        'numeric' => 'Your phone number must contain only digits.',
                        'min_length' => 'Your phone number must be 9 digits long.',
                        'max_length' => 'Your phone number must be exactly 9 digits long.',
                        'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                    ],
                    // Add similar error messages for other fields
                ];
            case 'step3':
                return [
                    'name' => 'Please enter your full name.',
                    'phone' => [
                        'required' => 'Your phone number is required.',
                        'numeric' => 'Your phone number must contain only digits.',
                        'min_length' => 'Your phone number must be 9 digits long.',
                        'max_length' => 'Your phone number must be exactly 9 digits long.',
                        'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                    ],
                    // Add similar error messages for other fields
                ];
            case 'step4':
                return [
                    'name' => 'Please enter your full name.',
                    'phone' => [
                        'required' => 'Your phone number is required.',
                        'numeric' => 'Your phone number must contain only digits.',
                        'min_length' => 'Your phone number must be 9 digits long.',
                        'max_length' => 'Your phone number must be exactly 9 digits long.',
                        'regex_match' => 'Your phone number must start with 7 and contain 9 digits.'
                    ],
                    // Add similar error messages for other fields
                ];
            case 'assetscommon':
                return[
                    'booked_by' => [
                        'required' => 'Booked by field is required.',
                    ],
                    'location' => [
                        'required' => 'Location field is required.',
                    ],
                    'hireDateTime' => [
                        'required' => 'Hire Date and Time field is required.',
                    ],
                    'returnDateTime' => [
                        'required' => 'Return Date and Time field is required.',
                    ],
                ];
            case 'assets':
                return [
                    'assetname' => [
                        'required' => 'Asset name is required.',
                    ],
                    'category' => [
                        'required' => 'Asset category is required.',
                    ],
                    'condition' => [
                        'required' => 'Asset condition is required.',
                    ],
                    'status' => [
                        'required' => 'Asset status is required.',
                    ],
                    'value' => [
                        'required' => 'Asset value is required.',
                    ],
                    'quantity' => [
                        'required' => 'Quantity is required.',
                    ],
                ];

            default:
                return [];
        }
    }
}
function handleFileUpload($fileFieldName, $uploadPath = WRITEPATH . 'uploads/')
{
    $file = $this->request->getFile($fileFieldName);
    if ($file->isValid() && !$file->hasMoved()) {
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        $file->move($uploadPath);
        return $file->getName();
    }
    return null; // Return null if upload fails or is not valid
}
function createFormData($postData, $fileName = null)
{
    return [
        'name' => $postData['yourname'],
        'phone' => $postData['yourphone'],
        'guardian_name' => $postData['guardianname'],
        'guardian_phone' => $postData['guardianphone'],
        'gender' => $postData['gender'],
        'home_diocese' => $postData['diocese'],
        'home_parish' => $postData['parish'],
        'academic_progression_status' => $postData['progression'],
        'family_jumuia' => $postData['family'],
        'semester_period' => $postData['semesterperiod'],
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
        'baptismal_certificate' => $fileName, // This will be null unless a file is uploaded
    ];
}