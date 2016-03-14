<?php

    $url = 'https://sandbox-api.postmen.com/v3/labels';
    $method = 'POST';
    $headers = array(
        "content-type: application/json",
        "postmen-api-key: 9131d155-316d-49a4-b75d-6a54e104c33f"
    );
    
    $body = '{
				"paper_size":"4x8",
				"service_type":"dhl_express_worldwide",
    			"is_document":false,
    			"shipper_account":{
					"id":"e97e282b-5c92-4541-9eb8-dfde98b487d7"
				},
				"shipment":{
					"parcels":[
						{
							"box_type":"custom",
							"weight":{
								"value":1.5,
								"unit":"kg"
							},
							"dimension":{
								"width":20,
								"height":30,
								"depth":40,
								"unit":"cm"
							},
							"items":[
								{
									"description":"Food Bar",
									"origin_country":"USA",
									"quantity":2,
									"price":{
										"amount":50,
										"currency":"USD"
									},
									"weight":{
										"value":0.6,
										"unit":"kg"
									},
									"sku":"Epic_Food_Bar",
									"hs_code":"11111111"
								}
							]
						}
					],
					"ship_from":{
						"country": "CAN",
						"contact_name": "Wan Li Ding",
						"phone": "1-403-504-5496",
						"fax": null,
						"email": null,
						"company_name": "The UPS Store #459",
						"street1": "3450 RUE SAINT-DENIS",
						"street2": null,
						"street3": null,
						"city": "MONTREAL",
						"state": "QC",
						"postal_code": "H2Z 3L3",
						"type": "business",
						"tax_id": null
					},
					"ship_to":{
						"contact_name":"Rick McLeod (RM Consulting)",
						"street1":"1000 Parkview Drive",
						"city":"Hallandale Beach",
						"state":"Florida",
						"postal_code":"33009",
						"country":"USA",
						"phone":"1-403-504-5496",
						"email":"test@test.test",
						"type":"residential"
					}
				},    		
    			"async":false,
				"return_shipment":false,
				"ship_date":"2016-03-08",
    		    "invoice":{
    				"date":"2016-03-08",
    				"number":"1234567890",
    				"type":"commercial",
    				"number_of_copies":2
    			},
			    "references":["001","002","004"],    		
    		    "billing":{
    		    	"paid_by":"shipper",
    				"method":{
    					"type":"account",
    					"account_number":"971472538",
    					"postal_code":"H2X 3L3",
    					"country":"CAN"
    				}
    			},    		
				"customs":{
    				"purpose":"merchandise",
    				"terms_of_trade":"dat",		
					"billing":{
						"paid_by":"shipper",
						"method":{
	    					"type":"account", 
	    					"account_number":"971472538", 
	    					"postal_code":"H2X 3L3", 
	    					"country":"CAN"
						}
					},
    		        "importer_address":{
    					"contact_name":"Oceanview Park",
						"street1":"1030 Parkview Drive",
						"city":"Hallandale Beach",
						"state":"Florida",
						"postal_code":"33009",
						"country":"USA",
						"phone":"1-403-504-5496",
						"email":"test@test.test",
						"type":"residential"
    				},
    		    	"passport":{
						"number":"ABC1233445", 
						"issue_date":"2010-02-27"
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
    	$result = json_decode($response,  $assoc=true);
    	//var_dump($result['data']);
    	$data = $result['data'];
    	$id = $data['id'];
    	$status = $data['status'];
    	$created_at = $data['created_at'];
    	$updated_at = $data['updated_at'];
    	$tracking_numbers = $data['tracking_numbers'][0];
    	echo "<pre>";
    	echo "id:".$id. PHP_EOL;
    	echo "status:".$status. PHP_EOL;
    	echo "created_at:".$created_at. PHP_EOL;
    	echo "updated_at:".$updated_at. PHP_EOL;
    	echo "tracking_numbers:".$tracking_numbers. PHP_EOL;
    	echo "</pre>";
    	echo $response;
    }
?>
