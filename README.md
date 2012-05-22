# Usage

The code is pretty self-explainatory, so I'll just leave it at that.

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