<?php

namespace ArdaGedik;

class BasicCache{

  // Location of cache files
	public $path;

	// Cache expiration time
	public $expire;

	// Last modified date of cache file
	public $modifiedTime;

	// The name of the file that the cache is running on
	public $fileName;

	// The name of the cached file
	public $cachedFileName;

	// The extension of the cached file
	public $cachedFileExt;

	// The path to the cached file
	public $cachedFilePath;

  // Constructor
	public function __construct($options = []){

		// Options
		$this->path  		 = $options['path'] ?? 'cache/';
		$this->expire 	 = $options['expire'] ?? 60;
		$this->extension = $options['extension'] ?? '.html';

		$this->fileName  = explode('.', basename($_SERVER['SCRIPT_NAME']))[0];
		$this->cachedFileName = md5($this->fileName).$this->extension;
		$this->cachedFilePath = $this->path.$this->cachedFileName;

		// Create if directory does not exist
		if( ! is_dir($this->path)) mkdir($this->path, 0755);
	}

}

?>
