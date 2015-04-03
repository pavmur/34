<?php

class LogsStandart extends Singleton implements ILogsStandart
{
	/**
	* @var string
	*/
	private $entryDelimiter = "|";

	/**
	* @var string
	*/
	private $itemDelimiter = "?";

	/**
	* @var string
	*/
	private $logsRegExp = "/[а-яА-Я\w\s\-_]+\?\d+\|/";

	protected function __construct() {}

	public function getEntryDelimiter()
	{
		return $this->entryDelimiter;
	}

	public function getItemDelimiter()
	{
		return $this->itemDelimiter;
	}

	public function getLogsRegExp()
	{
		return $this->logsRegExp;
	}
}