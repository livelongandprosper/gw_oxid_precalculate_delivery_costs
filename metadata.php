<?php
/**
 * @abstract
 * @author 	Gregor Wendland <gregor@gewend.de>
 * @copyright Copyright (c) 2018, Gregor Wendland
 * @package gw
 * @version 2018-11-21
 */

/**
 * Metadata version
 */
$sMetadataVersion = '2.0'; // see https://docs.oxid-esales.com/developer/en/6.0/modules/skeleton/metadataphp/version20.html

/**
 * Module information
 */
$aModule = array(
    'id'           => 'gw_oxid_precalculate_delivery_costs',
    'title'        => 'Versandkostenberechnung vor Versandart-Auswahl',
//     'thumbnail'    => 'out/admin/img/logo.jpg',
    'version'      => '1.0.0',
    'author'       => 'Gregor Wendland',
    'email'		   => 'kontakt@gewend.de',
    'url'		   => 'https://www.gewend.de',
    'description'  => array(
    	'de'		=> 'Ermöglicht die Berechnung von Versandkosten für einzelne Versandarten, bevor diese ausgewählt wurden. So können Versandkosten bereits vor der Auswahl durch den Benutzer angezeigt werden.',
    ),
    'extend'       => array(
		'oxbasket' => 'gw/gw_oxid_precalculate_delivery_costs/Application/models/gw_oxid_precalculate_delivery_costs_oxbasket',
		'oxdeliverylist' => 'gw/gw_oxid_precalculate_delivery_costs/Application/models/gw_oxid_precalculate_delivery_costs_oxdeliverylist',
    	'oxviewconfig' => 'gw/gw_oxid_precalculate_delivery_costs/Application/core/gw_oxid_precalculate_delivery_costs_oxviewconfig',
    ),
    'settings'		=> array(

    ),
	'events'		=> array(
    ),
    'files'			=> array(
    ),
	'blocks' => array(
	),
	'events'       => array(
	),
	'controllers'  => [
	],
	'templates' => [
	]
);
?>