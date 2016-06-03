<?php

define('FORCE_LOGIN', 1);

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ibiza_Auth
 * @subpackage Ibiza_Auth/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ibiza_Auth
 * @subpackage Ibiza_Auth/public
 * @author     Your Name <email@example.com>
 */
class Ibiza_Auth_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ibiza_auth    The ID of this plugin.
	 */
	private $ibiza_auth;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $ibiza_auth       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ibiza_auth, $version ) {

		$this->ibiza_auth = $ibiza_auth;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ibiza_Auth_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ibiza_Auth_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ibiza_auth, plugin_dir_url( __FILE__ ) . 'css/ibiza-auth-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ibiza_Auth_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ibiza_Auth_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ibiza_auth, plugin_dir_url( __FILE__ ) . 'js/ibiza-auth-public.js', array( 'jquery' ), $this->version, false );

	}

        
        
        

	/**
	 * Check if the user has authenticated.
	 *
	 * @since    1.0.0
	 */
	public function check_auth() {

            
            
		/**
		 *
		 * The Ibiza_Auth_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
                 * 
                 * If cookies from secure site is found set the user to be logged in
                 * 
                 * else
                 * 
                 * Set them as logged out
                 * 
		 */


                if ( FORCE_LOGIN  || ( isset($_COOKIE['ci']) && isset($_COOKIE['sk']) ) ) {
                    setcookie('logged_in', '1', strtotime('+30 day'));
                }else{
                    setcookie('logged_in', null, strtotime('-1 day'));
                }
                 
            
	}

        
        
        
        
}
