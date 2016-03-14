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

require(__DIR__ . '/../../init.php');

// DHL Settings
$dhl = $config['dhl'];

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
<req:DOCRequest xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemalocation="http://www.dhl.com DCT-req.xsd">
 <GetQuote>
  <request>
   <serviceheader>
    <messagetime>2002-08-20T11:28:56.000-08:00</messagetime>
    <messagereference>1234567890123456789012345678901</messagereference>
    <siteid>UPSStore459</siteid>
    <password>xFiyPkrK95</password>
   </serviceheader>
  </request>
  <from>
   <countrycode>CZ</countrycode>
   <postalcode>10000</postalcode>
   <city>PRAGUE</city>
  </from>
  <bkgdetails>
   <paymentcountrycode>CZ</paymentcountrycode>
   <date>2016-03-14</date>
   <readytime>PT10H21M</readytime>
   <readytimegmtoffset>+01:00</readytimegmtoffset>
   <dimensionunit>CM</dimensionunit>
   <weightunit>KG</weightunit>
   <pieces>
    <piece>
     <pieceid>1</pieceid>
     <height>10</height>
     <depth>5</depth>
     <width>10</width>
     <weight>10</weight>
    </piece>
   </pieces>
   <isdutiable>N</isdutiable>
  </bkgdetails>
  <to>
   <countrycode>SE</countrycode>
   <postalcode>10054</postalcode>
   <city>STOCKHOLM</city>
  </to>
 </GetQuote>
</req:DCTRequest>

';



$client = new WebserviceClient('staging');
$xml = $client->call($test);
echo PHP_EOL . 'Executed in ' . (microtime(true) - $start) . ' seconds.' . PHP_EOL;
echo $xml . PHP_EOL;

// $xml=simplexml_load_string($xml) or die("Error: Cannot create object");
// print_r($xml);

