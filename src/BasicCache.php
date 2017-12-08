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

}

?>
