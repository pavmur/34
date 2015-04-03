<?php

class Autoloader extends Singleton
{
	/**
	* ClassName => FileName
	* @var array
	*/
	private $classNames = array();

	/**
	* @return void
	*/
	protected function __construct()
	{
		spl_autoload_register(array($this, 'loadClass'));
	}

	/**
	* @param string $dirName
	* @return void
	*/
	public function registerDirectory($dirName)
	{
		$di = new DirectoryIterator($dirName);

		foreach ($di as $file) {
			if ($this->isAppropriateFile($file)) {
				$this->registerDirectory($file->getPathname());
			} elseif ($this->isPHPFile($file)) {
				$this->registerClass(substr($file->getFilename(), 0, -4), $file->getPathname());
			}
		}
	}

	/**
	* @param string $className
	* @return void
	*/
	public function loadClass($className)
	{
		if (isset($this->classNames[$className])) {
			require_once($this->classNames[$className]);
		}
	}

	/**
	* @param string $className
	* @param string $fileName
	* @return void
	*/
	private function registerClass($className, $fileName)
	{
		$this->classNames[$className] = $fileName;
	}

	/**
	* @param DirectionIterator $file
	* @return boolean
	*/
	private function isAppropriateFile(DirectoryIterator $file)
	{
		return $file->isDir() && !$file->isLink() && !$file->isDot();
	}

	/**
	* @param DirectionIterator $file
	* @return boolean
	*/
	private function isPHPFile($file)
	{
		return substr($file->getFilename(), -4) === '.php';
	}
}