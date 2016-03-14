<?php 
/**
 * File:        Web.php
 * Project:     DHL API
 *
 * @author      Al-Fallouji Bashar
 * @version     0.1
 */

namespace DHL\Lib;

/**
 * DHL Lib Util
 */
class Util 
{
  public function __construct(){
    
  }
  public function toHtml($xml){
    return '<pre>'.htmlentities($xml).'</pre>';
  }
}