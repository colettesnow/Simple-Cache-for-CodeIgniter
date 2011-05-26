<?php

/*

	Simple Cache for CodeIgniter
	By Colette Snow <colette.a.snow@gmail.com>
	http://colettesnow.com

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/

class Simple_cache {
 
	/**
	 * @var int containing the number of seconds that a cached item will be considered current
	 */
	public $expire_after = 300;

	/**
	 * Caches an item which can be retrieved by key
	 *	
	 * @param string $key identitifer to retrieve the data later
	 * @param mixed $value to be cached
	 */
	function cache_item($key, $value)
	{
		// hashing the key in order to ensure that the item is stored with an appropriate file name in the file system.	
		$key = sha1($key);
		
		// serialises the contents so that they can be stored in plain text
		$value = serialize($value);
		
		file_put_contents(BASEPATH.'cache/'.$key.'.cache', $value);		
	
	}
	
	/**
	 * Check's whether an item is cached or not
	 * 
	 * @param string $key containing the identifier of the cached item
	 * @return bool whether the item is currently cached or not
	 */ 
	function is_cached($key)
	{
		$key = sha1($key);
		// checks if the cached item exists and that it has not expired. 
		if (file_exists(BASEPATH.'cache/'.$key.'.cache') && (filectime(BASEPATH.'cache/'.$key.'.php')+$this->expire_after) >= time())
		{			
			return true;
		} else {
			return false;			
		}		
	}
	
	/**
	 * Retrieve's the cached item
	 *
	 * @param string $key containing the identifier of the item to retrieve
	 * @return mixed the cached item or items
	 */
	function get_item($key)
	{
		$key = sha1($key);
		$item = file_get_contents(BASEPATH.'cache/'.$key.'.cache');
		$items = unserialize($item);
		
		return $items;
	}
	
	/**
	 * Delete's the cached item
	 * 
	 * @param string $key containing the identifier of the item to delete.
	*/
	function delete_item($key)
	{
		unlink(BASEPATH.'cache/'.sha1($key).'.cache');
	}

}