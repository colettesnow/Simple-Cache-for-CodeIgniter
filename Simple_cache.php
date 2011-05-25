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

	public $expire_after;

	function Simple_cache()
	{
		if ($this->expire_after == '')
		{
			 $this->expire_after = 300;
		}
	}

	function cache_item($key, $value)
	{
	
		$key = sha1($key);
		
		$value = serialize($value);
		
		file_put_contents(BASEPATH.'cache/'.$key.'.cache', $value);		
	
	}
	
	function is_cached($key)
	{
		$key = sha1($key);
		if (file_exists(BASEPATH.'cache/'.$key.'.cache') && (filectime(BASEPATH.'cache/'.$key.'.php')+$this->expire_after) >= time())
		{			
			return true;
		} else {
			return false;			
		}		
	}
	
	function get_item($key)
	{
		$key = sha1($key);
		$item = file_get_contents(BASEPATH.'cache/'.$key.'.cache');
		$items = unserialize($item);
		
		return $items;
	}
	
	function delete_item($key)
	{
		unlink(BASEPATH.'cache/'.sha1($key).'.cache');
	}

}

