<?php
/*
	Veloce Framework
    Copyright (C) 2012 Pierre Ferran in collaboration with Jean-Baptiste Kaloya

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
class Cache{

	private $dirOfCache;
	private $duration;
	private $buffer;

	public function __construct($cacheConf)
	{
		$this->dirOfCache = $cacheConf["directory"];
		$this->duration = $cacheConf["duration"];
	}

	public function write($filename, $content)
	{
		file_put_contents($this->dirOfCache.'/'.$filename.'.ve', $content);
	}

	public function get($filename)
	{
		$filePath = $this->dirOfCache.'/'.$filename.'.ve';
		$timeOfFile = (time() - filemtime($filePath)) / 60;

		if(!file_exists($filePath))
		{
			return false;
		}

		if($timeOfFile > $this->duration)
		{
			return false;
		}
		else
		{
			return file_get_contents($filePath);
		}
	}

	public function delete($filename)
	{
		$filePath = $this->dirOfCache.'/'.$filename.'.ve';
		if(file_exists($filePath))
		{
			unlink($filePath);
		}

	}

	public function clear()
	{
		$files = glob($this->dirOfCache.'/*');
		foreach ($files as $file) {
			unlink($file);
		}
	}


	public function inc($file, $cachename = null)
	{
		if(!$cachename)
		{
			$cachename = explode('.', $filename);
			$cachename = $cachename[1].'.ve';
		}

		$filename = basename($file);
		if($content = $this->get($cachename))
		{
			echo $content;
			return true;
		}
		ob_start();
		require $file;
		$content = ob_get_clean();
		
		$this->write($cachename, $content);
		echo $content;
		return true;
	}

	public function start($cachename)
	{
		ob_start();
		$this->buffer = $cachename;
	}

	public function end()
	{
		$content = ob_get_clean();
		$this->write($this->buffer, $content);
	}

}

?>