<?php
/**
 * Default Sample Configuration file
 *
 * Copy and customize this file with your own settings
 *
 * You may create custom configuration file based on the following environment variable : APPLICATION_ENVIRONMENT.
 * The naming to respect is the following : 
 *
 *  conf/config-{APPLICATION_ENVIRONMENT}.php
 *
 *  e.g. conf/config-production.php | conf/config-staging.php | conf/config-commondev.php
 *
 * @project DHL
 */
return array(
    // AutoloadManager options
    'autoloader' => array(

        // Only scan once when a class is not found in the class map (this should be set to SCAN_NONE on production environment
        'scanOptions' => autoloadManager::SCAN_ONCE,

        // complete path to autoload file that contains the class map 
        'dir' => sys_get_temp_dir() . '/dhl-api-autoload.php',
    ),

    // DHL related settings    
    'dhl' => array(
        // ID to use to connect to DHL
        'id' => 'UPSStore459',

        // Password to use to connect to DHL
        'pass' => 'xFiyPkrK95',

        // Shipper, Billing and Duty Account numbers
        'shipperAccountNumber' => '971472538',
        'billingAccountNumber' => '971472538',
        'dutyAccountNumber' => '971472538',
    ),
);
