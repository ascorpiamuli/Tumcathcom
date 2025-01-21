<?php
namespace App\Libraries;

class Mpesa {

    private $shortcode;
    private $passkey;
    private $access_token;
    private $consumer_key;
    private $consumer_secret;

    public function __construct() {
        // Set your sandbox credentials
        $this->shortcode = '174379'; // Your Shortcode
        $this->passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Passkey from Safaricom
        $this->consumer_key = '0IRmxZPvgAIJ30zXGVAGxLHiFl49tS9hGkK0Bs0yXVHQguX7'; // Your Consumer Key
        $this->consumer_secret = 'kjFJVCraMPKCMuqTSAEXAelJvu6VfwqFybJ5DfOtOzvkQSkGTWEH90DlexnBMa7Z'; // Your Consumer Secret
    }

    private function generate_token() {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init($url);
    
        $headers = array(
            'Authorization: Basic ' . base64_encode($this->consumer_key . ':' . $this->consumer_secret)
        );
    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
    
        if ($http_status == 200 && $response) {
            $data = json_decode($response);
    
            if (isset($data->access_token)) {
                $this->access_token = $data->access_token;
                return $this->access_token;
            }
        }
    
        return null;
    }

    public function lipa_na_mpesa($phone_number, $amount) {
        try {
            $token = $this->generate_token();
            if (!$token) {
                throw new \Exception('Failed to generate access token.');
            }

            $phone_number = format_phone_number($phone_number);

            $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $timestamp = date("YmdHis");
            $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

            $data = array(
                "BusinessShortCode" => $this->shortcode,
                "Password" => $password,
                "Timestamp" => $timestamp,
                "TransactionType" => "CustomerPayBillOnline",
                "Amount" => intval($amount),
                "PartyA" => $phone_number,
                "PartyB" => $this->shortcode,
                "PhoneNumber" => $phone_number,
                "CallBackURL" => "https://example.com/callback", // Replace with your callback URL
                "AccountReference" => 'TUMCATHCOM',
                "TransactionDesc" => 'Ascorpi'
            );

            $headers = array(
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                throw new \Exception('CURL error: ' . curl_error($ch));
            }

            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($http_status != 200) {
                throw new \Exception('MPESA API error: ' . $response);
            }

            return json_decode($response, true);
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }
}
