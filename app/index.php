<?php

require_once('inc/config.php');

$variables = [
    'id' => 1
];

$result = api_request("get_datetime", 'GET', $variables);
echo "<pre>";
print_r($result);
echo "</pre>";


// ==========================================================================
function api_request($endpoint, $method = 'GET', $variables = [])
{
    $curl = curl_init();
    $headers = array(
        'Content-Type: application/json',
        'Authorization: Basic ' . base64_encode(API_USER . ':' . API_PASS)
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    // defines the url
    $url = API_BASE_ENDPOINT . $endpoint . '/';

    // if request is GET
    if ($method == 'GET') {
        if (!empty($variables)) {
            $url .= '?' . http_build_query($variables);
        }
    }

    //if request is POST
    if ($method == 'POST') {
        $variables = array_merge(['endpoint' => $endpoint], $variables);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $variables);
    }

    curl_setopt($curl, CURLOPT_URL, $url);

    $response = curl_exec($curl);

    // check for errors
    if (curl_errno($curl)) {
        throw new Exception(curl_error($curl));
    }

    curl_close($curl);

    return json_decode($response, true);
}
