<?php

namespace BoxberryListPoints\Controllers\Update\ListPoints;

use BoxberryListPoints\Configuration\Constants;

class BoxberryClient
{
    private string $token;

    public function __construct($token = Constants::BOXBERRY['token'])
    {
        $this->token = $token;
    }

    public function getData($param, ?string $saveInFilePath = null)
    {
        $curl = curl_init();
        $queryString = http_build_query(array_merge(['token' => $this->token], $param));
        $curlParam = [
            CURLOPT_URL => 'https://api.boxberry.ru/json.php?' . $queryString,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ];

        if ($saveInFilePath && file_exists($saveInFilePath)) $curlParam[CURLOPT_FILE] = $saveInFilePath;

        curl_setopt_array($curl, $curlParam);

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }
}