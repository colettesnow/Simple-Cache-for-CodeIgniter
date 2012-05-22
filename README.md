# Simple Cache for CodeIgniter Readme
Developed by [Colette Snow](http://colettesnow.com/) and released under the GNU General Public License (see LICENSE).

## About

Simple Cache for CodeIgniter is an open source file based fragment caching library released under the GNU General Public License. It was designed to be simple to use and easily adaptable to use alternate backends if this was needed in the future.

It should also be usable in non-CodeIgniter applications.

## Requirements

* A webserver
* PHP 5.0 or later
* Write access to the /cache/ directory

## Installation

Simply place Simple_cache.php in your CodeIgniter application's libraries directory.

## Usage

The following code should be self-explanatory.

## Code with CodeIgniter

```php
<?php
class Test extends Controller {

	function main()
	{

		// load the library
		$this->load->library('simple_cache');

		// key is the name you have given to the cached data
		// will check if the item is cached or 
		if (!$this->simple_cache->is_cached('key'))
		{
			// not cached, do our things that need caching
			$data = array('print' => 'Hello World');
	
			// store in cache
			$this->simple_cache->cache_item('key', $data);
	
		} else {
			$data = $this->simple_cache->get_item('key');
		}

		$this->load->view('hello', $data);
	}
	
}
?>
```

## Code for non-CodeIgniter users

```php
<?php
require_once 'Simple_cache.php';

// your cache would be located in /path/to/directory/cache in this case
define('BASEPATH', '/path/to/directory/');

$cache = new Simplecache;

if (!$cache->is_cached('key'))
{

	$data = array('print' => 'Hello World');	

	$cache->cache_item('key', $data);

} else {

	$data = $cache->get_item('key');	

}

// outputs Hello World
echo $data['print'];
?>
```

## Recommendations

* It is recommended your CodeIgniter application, specifically the cache directory be located outside the web root (www/htdocs/public_html).