<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	 * SecurityCheck class declaration
	 */
	class SecurityCheck
	{
	    /**
	     * constructor
	     */
	    private $domains;
	    public function __construct() {
	    	$this->domains = array('localhost');
	    }

	    public function authentication() 
	    {
	    	if (!in_array($_SERVER['SERVER_NAME'], $this->domains) ) {
			    include(APPPATH.'views/errors/404_error.php');die;
			}
			if ($this->get_ip_address() !== $this->get_ip_address(true)) {
			    include(APPPATH.'views/errors/404_error.php');die;
			} 
	    }

	    function get_ip_address($proxy = false)
		{
		    if ($proxy === true) {
		        foreach (array('HTTP_CLIENT_IP','HTTP_X_CLUSTER_CLIENT_IP') as $key) {
		            if (array_key_exists($key, $_SERVER) === true) {
		                foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip) {
		                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
		                        return $ip;
		                    }
		                }
		            }
		        }
		    }

		    return $_SERVER['REMOTE_ADDR'];
		}
	} /* end of class */

?>
