<?php 
/*
* Include all files in inc folder
*/
foreach ( glob( plugin_dir_path( __FILE__ ) . 'inc/*.php' ) as $filename ) {
	require_once $filename;
}