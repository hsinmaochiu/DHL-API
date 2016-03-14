<?php

    $url = 'https://sandbox-api.postmen.com/v3/rates';
    $method = 'POST';
    $headers = array(
        "content-type: application/json",
    	"postmen-api-key: 9131d155-316d-49a4-b75d-6a54e104c33f"
    );

    $body = '{
				
				"async":false,
				"shipper_accounts":[
					{
						"id":"e97e282b-5c92-4541-9eb8-dfde98b487d8"
					}
				],
				"shipment":{
					"parcels":[
						{
							"box_type":"dhl_express_document",
							"weight":{
								"value":0.22,
								"unit":"lb"
							},
							"dimension":{
								"width":10,
								"height":1,
								"depth":10,
								"unit":"in"
							},
							"items":[
								{
									"description":"PS4",
									"origin_country":"JPN",
									"quantity":2,
									"price":{
										"amount":50,
										"currency":"JPY"
									},
									"weight":{
										"value":0.6,
										"unit":"kg"
									},
									"sku":"PS4-2015"
								}
							]
						}
					],
					"ship_from":{
						"contact_name": "Yin Ting Wong",
						"street1": "1021 rue Gameroff",
						"city": "Montreal",
						"state": "Quebec",
    					"postal_code":"h2x 3l3",
						"country": "CAN",
						"phone": "96679797",
						"email": "test@test.test",
						"type": "residential"
					},
					"ship_to":{
						"contact_name":"Mike Carunchia",
						"street1":"9504 W Smith ST",
						"city":"Beijing",
						"state":"Beijing",
						"postal_code":"100000",
						"country":"CHN",
						"phone":"7657168649",
						"email":"test@test.test",
						"type":"residential"
					}
				}
			}';
    
    
    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
		CURLOPT_POSTFIELDS => $body
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
