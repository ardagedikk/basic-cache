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

  // Start
	public function start(){

		// If the time has not expired
		if($this->checkExpire($this->expire, $this->cachedFilePath)){

			// Read the cached file
			readfile($this->cachedFilePath);
			exit();

		}else{

			// Start buffer
			ob_start();

		}

	}

	// End
	public function end(){

		// If the time has expired
		if( ! $this->checkExpire($this->expire, $this->cachedFilePath)){

			// Write the buffer data to the cache file
			$open 	 = fopen($this->cachedFilePath, 'w+');
			fwrite($open, $this->outputMinify(ob_get_flush()));
			fclose($open);

		}

	}

  // Clear cache
	public function clear(){

		// Remove cache directory
		return $this->removeDir($this->path);
	}

  // Check expire
	private function checkExpire($expire, $file){

		// If the expiry time is less than the last modified date of the file
		if(file_exists($file)) return ((time() - $expire) < filemtime($file));
	}

  // Output minifier
	private function outputMinify($output){

		 $search = array(
			  '/\>[^\S ]+/s',     // Strip whitespaces after tags, except space
        '/[^\S ]+\</s',     // Strip whitespaces before tags, except space
        '/(\s)+/s',         // Shorten multiple whitespace sequences
        '/<!--(.|\s)*?-->/' // Remove HTML comments
    );

    $replace = array('>', '<', '\\1', '');
    $output  = preg_replace($search, $replace, $output);
		return $output;

	}

	// Remove directory
	private function removeDir($dir) {

		// Look at each everything in the directory
		// Delete if directory or file
		foreach(glob($dir.'/*') as $file) {
			if(is_dir($file)) rrmdir($file); else unlink($file);
		}

		// Remove directory
		rmdir($dir);
	}

}

?>
