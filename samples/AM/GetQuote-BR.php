<?php
/**
 * Note : Code is released under the GNU LGPL
 *
 * Please do not change the header of this file
 *
 * This library is free software; you can redistribute it and/or modify it under the terms of the GNU
 * Lesser General Public License as published by the Free Software Foundation; either version 2 of
 * the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * See the GNU Lesser General Public License for more details.
 */

/**
 * File:        GetQuote.php
 * Project:     DHL API
 *
 * @author      Al-Fallouji Bashar
 * @version     0.1
 */

use DHL\Entity\AM\GetQuote;
use DHL\Datatype\AM\PieceType;
use DHL\Client\Web as WebserviceClient;
use DHL\Lib\Util;

require(__DIR__ . '/../../init.php');

// DHL Settings
$dhl = $config['dhl'];

//Create a util object
$util = new Util();

// Test a getQuote using DHL XML API
$sample = new GetQuote();
$sample->SiteID = $dhl['id'];
$sample->Password = $dhl['pass'];

// Set values of the request
$sample->MessageTime = '2002-08-20T11:28:56.000-08:00';
$sample->MessageReference = '1234567890123456789012345678901';
$sample->BkgDetails->Date = date('Y-m-d');

$piece = new PieceType();
$piece->PieceID = 1;
$piece->Height = 10;
$piece->Depth = 5;
$piece->Width = 10;
$piece->Weight = 10;
$sample->BkgDetails->addPiece($piece);
$sample->BkgDetails->IsDutiable = 'N';
// $sample->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';
$sample->BkgDetails->ReadyTime = 'PT10H21M';
$sample->BkgDetails->ReadyTimeGMTOffset = '+01:00';
$sample->BkgDetails->DimensionUnit = 'CM';
$sample->BkgDetails->WeightUnit = 'KG';
$sample->BkgDetails->PaymentCountryCode = 'CZ';
// $sample->BkgDetails->IsDutiable = 'Y';

// Request Paperless trade
// $sample->BkgDetails->QtdShp->QtdShpExChrg->SpecialServiceType = 'WY';

$sample->From->CountryCode = 'CZ';
$sample->From->Postalcode = '10000';
$sample->From->City = 'PRAGUE';

$sample->To->CountryCode = 'SE';
$sample->To->Postalcode = '10054';
$sample->To->City = 'STOCKHOLM';
// $sample->Dutiable->DeclaredValue = '100.00';
// $sample->Dutiable->DeclaredCurrency = 'CHF';

// Call DHL XML API
$start = microtime(true);
//echo $sample->toXML();

/*
<SiteID>UPSStore459</SiteID>
<Password>xFiyPkrK95</Password>
*/

$test = '<?xml version="1.0" encoding="UTF-8"?>
<p:DCTRequest xmlns:p="http://www.dhl.com" xmlns:p1="http://www.dhl.com/datatypes" xmlns:p2="http://www.dhl.com/DCTRequestdatatypes" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com DCT-req.xsd ">
  <GetQuote>
    <Request>
      <ServiceHeader>
        <MessageTime>2002-08-20T11:28:56.000-08:00</MessageTime>
        <MessageReference>1234567890123456789012345678901</MessageReference>
        <SiteID>UPSStore459</SiteID>
        <Password>xFiyPkrK95</Password>
      </ServiceHeader>
    </Request>
    <From>
      <CountryCode>BR</CountryCode>
      <Postalcode>04304</Postalcode>
    </From>
    <BkgDetails>
      <PaymentCountryCode>BR</PaymentCountryCode>
      <Date>2016-03-24</Date>
      <ReadyTime>PT10H21M</ReadyTime>
      <ReadyTimeGMTOffset>+01:00</ReadyTimeGMTOffset>
      <DimensionUnit>CM</DimensionUnit>
      <WeightUnit>KG</WeightUnit>
      <Pieces>
        <Piece>
          <PieceID>1</PieceID>
          <Height>10</Height>
          <Depth>20</Depth>
          <Width>30</Width>
          <Weight>10.0</Weight>
        </Piece>
      </Pieces>      
      <IsDutiable>Y</IsDutiable>
      <NetworkTypeCode>AL</NetworkTypeCode>   
    </BkgDetails>
    <To>
      <CountryCode>US</CountryCode>
      <Postalcode>33324</Postalcode>
    </To>
   <Dutiable>
      <DeclaredCurrency>USD</DeclaredCurrency>
      <DeclaredValue>1002.0</DeclaredValue>
    </Dutiable>
  </GetQuote>
</p:DCTRequest>

';

echo $util->toHtml($test);

$client = new WebserviceClient('staging');
$xml = $client->call($test);
echo PHP_EOL . 'Executed in ' . (microtime(true) - $start) . ' seconds.' . PHP_EOL;
echo $util->toHtml($xml);

// $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
// print_r($xml);

