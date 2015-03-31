<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.2.4 or newer
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is
 * bundled with this package in the files license.txt / license.rst.  It is
 * also available through the world wide web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world wide web, please send an email to
 * licensing@ellislab.com so we can send you a copy immediately.
 *
 * @package		CodeIgniter
 * @author		EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2012, EllisLab, Inc. (http://ellislab.com/)
 * @license		http://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

/**
 * Exceptions Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Exceptions
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/exceptions.html
 */
class MY_Exceptions extends CI_Exceptions {

	/**
	 * 404 Page Not Found Handler
	 *
	 * @param	string	the page
	 * @param 	bool	log error yes/no
	 * @return	string
	 */
	public function show_404($page = '', $log_error = TRUE)
	{
		$heading = '404 Page Not Found';
		$message = 'The page you requested was not found.';

		// By default we log this, but allow a dev to skip it
		if ($log_error)
		{
			log_message('error', '404 Page Not Found --> '.$page);
		}

		echo $this->show_error($heading, $message, '404', 404);
		exit;
	}

	// --------------------------------------------------------------------

	/**
	 * General Error Page
	 *
	 * This function takes an error message as input
	 * (either as a string or an array) and displays
	 * it using the specified template.
	 *
	 * @param	string	the heading
	 * @param	string	the message
	 * @param	string	the template name
	 * @param 	int	the status code
	 * @return	string
	 */
	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		$theme_path = WWW_FOLDER.'public/themes/jakarta/';

		// if CI_Controller has been loaded, 
		// this check is used for MyHookClass
		if(class_exists('CI_Controller')){
			$CI = &get_instance();
			$theme_path = $CI->template->get_theme_path();
		}


		set_status_header($status_code);

		$message = '<p>'.implode('</p><p>', is_array($message) ? $message : array($message)).'</p>';

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		if(file_exists($theme_path.'views/layouts/'.$template.'.php'))
			include($theme_path.'views/layouts/'.$template.'.php');
		else
			include(VIEWPATH.'errors/'.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	// --------------------------------------------------------------------

	/**
	 * Native PHP error handler
	 *
	 * @param	int	$severity	Error level
	 * @param	string	$message	Error message
	 * @param	string	$filepath	File path
	 * @param	int	$line		Line number
	 * @return	string	Error page output
	 */
	public function show_php_error($severity, $message, $filepath, $line)
	{
		$templates_path = config_item('error_views_path');
		if (empty($templates_path))
		{
			$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
		}

		$severity = isset($this->levels[$severity]) ? $this->levels[$severity] : $severity;

		// For safety reasons we don't show the full file path in non-CLI requests
		if ( ! is_cli())
		{
			$filepath = str_replace('\\', '/', $filepath);
			if (FALSE !== strpos($filepath, '/'))
			{
				$x = explode('/', $filepath);
				$filepath = $x[count($x)-2].'/'.end($x);
			}
		}

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		include($templates_path.'error_php.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

}

/* End of file Exceptions.php */
/* Location: ./system/core/Exceptions.php */