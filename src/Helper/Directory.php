<?php

namespace Dot\Helper;

!defined('WPINC ') or die();

/**
 * Helper library for Dot framework
 *
 * @package    Dot
 * @subpackage Dot\Includes
 */

trait Directory
{
	/**
	 * Get lists of directories
	 * @return  void
	 * @var     string  $path   Directory path
	 */
	public function getDir($path, $directories = [])
	{
		foreach (glob($path . '/*', GLOB_ONLYDIR) as $dir) {
			$directories[] = basename($dir);
		}
		return $directories;
	}

	/**
	 * Get files within directory
	 * @return  array
	 * @var     string  $dir   framework hooks directory (Api, Controller)
	 */
	public function getDirFiles($dir, &$results = [])
	{
		if (!is_dir($dir)) {
			return $results;
		}
		$files = scandir($dir);
		foreach ($files as $key => $value) {
			$path = sprintf('%s/%s', $dir, $value);
			$path = realpath($path);
			if (!is_dir($path)) {
				$results[] = $path;
			} elseif ($value != '.' && $value != '..') {
				$this->getDirFiles($path, $results);
			}
		}
		return $results;
	}

	/**
	 * Delete directories and files
	 * @return void
	 */
	public function deleteDir($dirPath)
	{
		if (!is_dir($dirPath)) {
			throw new \InvalidArgumentException("$dirPath must be a directory");
		}
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				self::deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}
}
