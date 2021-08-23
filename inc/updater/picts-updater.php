<?php

if( ! class_exists( 'Picts_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . '/updater.php' );
}

$updater = new Picts_Updater( __FILE__ );
$updater->set_username( 'primaryict' );
$updater->set_repository( 'picts-subpages' );
/*
	$updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();
