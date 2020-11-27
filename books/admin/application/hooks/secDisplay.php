<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class secDisplay 
{
	function commonDisplay() 
	{
		
		$CI =& get_instance();

			$buffer = $CI->output->get_output();
			$search = array(
				  '{__CSSLINKS__}',
			      '{__HEADER__}',
			      '{__METATAGS__}',
				  '{__FOOTER__}',
				  '{__FOOTERLINKS__}',
				  '{__SIDEBAR__}'
			);
			$data=array();

			$replace = array(
				$CI->load->view('include/csslinks',$data,true),
				$CI->load->view('include/header',$data,true),
				$CI->load->view('include/metatags',$data,true),
				$CI->load->view('include/footer',$data,true),
				$CI->load->view('include/footerlinks',$data,true),
				$CI->load->view('include/sidebar',$data,true),
			);
			$buffer = preg_replace($search, $replace, $buffer);
			$CI->output->set_output($buffer);
			$buffer = $CI->output->get_output();
			$CI->output->_display();
		
	}


}
