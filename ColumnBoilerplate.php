<?php
/**
 * Plugin Name: Chef Boilerplate Column
 * Plugin URI: http://chefduweb.nl/plugins/column-boilerplate
 * Description: Default Column started kit
 * Version: 1.0
 * Author: Luc Princen
 * Author URI: http://www.chefduweb.nl/
 * License: GPLv2
 * 
 * @package Cuisine
 * @category Core
 * @author Chef du Web
 */

//Chaning the namespaces is the most important part, 
//after that the bus pretty much drives itself.
namespace BoilerplateColumn;

use Cuisine\Wrappers\Script;
use Cuisine\Wrappers\Sass;
use Cuisine\Utilities\Url;


class ColumnIgniter{ 

	/**
	 * Static bootstrapped BoilerplateColumn\ColumnIgniter instance.
	 *
	 * @var \BoilerplateColumn\ColumnIgniter
	 */
	public static $instance = null;


	/**
	 * Init admin events & vars
	 */
	function __construct(){

		//register column:
		$this->register();

		//load the right files
		$this->load();

		//assets:
		$this->enqueues();


	}


	/**
	 * Register this column-type with Chef Sections
	 * 
	 * @return void
	 */
	private function register(){


		add_filter( 'chef_sections_column_types', function( $types ){

			$base = Url::path( 'plugin', 'chef-default-column', true );

			//change the $types[ key ] and the name value:
			$types['boilerplate'] = array(
						'name'		=> 'Kolom',
						'class'		=> 'BoilerplateColumn\Column',
						'template'	=> $base.'Assets/template.php'
			);

			return $types;

		});

	}

	/**
	 * Load all includes for this plugin
	 * 
	 * @return void
	 */
	private function load(){

		//only if Chef Sections is loaded as well:
		add_action( 'init', function(){

			include( 'Classes/Column.php' );

		});

	}


	/**
	 * Enqueue scripts & Styles
	 * 
	 * @return void
	 */
	private function enqueues(){

		add_action( 'init', function(){

			//javascript files for front-end use:
			
			//$url = Url::plugin( 'chef-default-column', true ).'Assets/js/';
			//Script::register( 'column-script', $url.'script', false );
			

			//sass files for front-end use:
			
			//$url = 'chef-default-column/Assets/sass/';
			//Sass::register( 'column-sass', $url.'_style.scss', false );
		
		});
	}

	/*=============================================================*/
	/**             Getters & Setters                              */
	/*=============================================================*/


	/**
	 * Init the \BoilerplateColumn\ColumnIgniter Class
	 *
	 * @return \BoilerplateColumn\ColumnIgniter
	 */
	public static function getInstance(){
		
	    return static::$instance = new static();

	}


}


add_action('cuisine_loaded', function(){

	\BoilerplateColumn\ColumnIgniter::getInstance();

});
