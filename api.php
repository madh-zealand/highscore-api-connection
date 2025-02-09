<?php

function apiGet(string $url)
{
    $token = '6|c1Xknxr4vS7oXm4yTZQeTWx9VUutkWrj4kHFVj9A8f3cba58';
    $headers = [
        'Accept: application/json',
        'Content-type: application/json',
        'Authorization: Bearer ' . $token,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    $responseData = curl_exec($curl);

    // Check if the response code indicates an error.
    // 4xx and 5xx are client errors and server errors.
    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($responseCode >= 400) {
        echo 'HTTP Error: ' . $responseCode;
        echo $responseData;
        exit;
    }

    curl_close($curl);

    return $responseData;
}

function apiPost(string $url, array $payload) {
    $token = '6|c1Xknxr4vS7oXm4yTZQeTWx9VUutkWrj4kHFVj9A8f3cba58';
    $headers = [
        'Accept: application/json',
        'Content-type: application/json',
        'Authorization: Bearer ' . $token,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($payload),
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    $responseData = curl_exec($curl);

    // Check if the response code indicates an error.
    // 4xx and 5xx are client errors and server errors.
    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($responseCode >= 400) {
        echo 'HTTP Error: ' . $responseCode;
        echo $responseData;
        exit;
    }

    curl_close($curl);

    return $responseData;
}

function apiDelete(string $url) {
    $token = '6|c1Xknxr4vS7oXm4yTZQeTWx9VUutkWrj4kHFVj9A8f3cba58';
    $headers = [
        'Accept: application/json',
        'Content-type: application/json',
        'Authorization: Bearer ' . $token,
    ];

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true,
    ]);
    $responseData = curl_exec($curl);

    // Check if the response code indicates an error.
    // 4xx and 5xx are client errors and server errors.
    $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($responseCode >= 400) {
        echo 'HTTP Error: ' . $responseCode;
        echo $responseData;
        exit;
    }

    curl_close($curl);

    return $responseData;
}


