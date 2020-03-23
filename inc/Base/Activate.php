<?php
/**
 * @package  Gpltimes
 */
namespace Inc\Base;

class Activate
{
	public static function activate() {
		ob_start();
		flush_rewrite_rules();
		
	}
}