<?php

interface ILogsStandart
{
	/**
	* @return string
	*/
	public function getEntryDelimiter();

	/**
	* @return string
	*/
	public function getItemDelimiter();

	/**
	* @return string
	*/
	public function getLogsRegExp();
}