<?php

    $url = 'https://sandbox-api.postmen.com/v3/labels';
    $method = 'GET';
    $headers = array(
        "content-type: application/json",
        "postmen-api-key: 9131d155-316d-49a4-b75d-6a54e104c33f"
    );

    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    	echo "cURL Error #:" . $err;
    } else {
    	echo $response;
    }
?>
