<?php
/**
 * Plugin Name: Customer Management
 * Description: You can Easily manage Your Customer
 * Version: 1.0.0
 */

if(!defined('ABSPATH'))
{
	die('invalid');
}
add_shortcode('pritesh-patel', 'priteshpatel');
function priteshpatel($atts)
{
	$atts =  shortcode_atts( [
     'name'=>'Pritesh Patel',
    ], $atts );
	echo "<h1>Hello".$atts['name']."</h1>";
}

