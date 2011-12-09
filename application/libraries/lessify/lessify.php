<?php
/**
 * Lessify for CodeIgniter v0.1
 * http://craigy.co.uk/ci-lessify
 *
 * Copyright 2011, Craig Sansam <craig@craigy.co.uk>
 * Licensed under MIT or GPLv3, see LICENSE
 */
 
require_once('lessc.inc.php');

class Lessify
{
	public function __construct()
	{
		$this->_ci =& get_instance();
	}
	    
	function file($source_file, $save_file = NULL)
	{
		$less = new lessc($source_file);
		$css = $less->parse();
				
		if ($save_file === NULL)
		{
			// Return
			return($css);
		}
		else
		{
			// Save to file
			$this->_ci->load->helper('file');
			write_file($save_file, $css);
		}
	}
	
	function directory($directory, $save_file = NULL)
	{
		$this->_ci->load->helper(array('directory', 'file'));
		
		$directory_map = directory_map($directory);
		
		$contents = '';
		
		foreach ($directory_map as $file)
		{
			$extension = explode(".", $file);
			$extension = $extension[count($extension)-1];
			
			if ($extension == "less")
			{			
				$less = new lessc($directory.'/'.$file);
				
				if ($contents != "") $contents .= "\n\n";
				
				$contents .= '/* @fileRef '.$file.' */'."\n";
				$contents .= $less->parse();
			}
			else
			{
				$contents .= "\n\n" . ' /* File ' . $file . ' is not allowed' . "\n";
			}			
		}
		
		if ($save_file === NULL)
		{
			// Return
			return $contents;
		}
		else
		{
			// Save to file
			$this->_ci->load->helper('file');
			write_file($save_file, $css);
		}
	}
}