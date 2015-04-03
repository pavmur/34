<?php

class Bookkeeping implements IBookkeeping
{
	/**
	* @var ILogsStandart
	*/
	private $logsStd;

	function __construct(ILogsStandart $logsStandart)
	{
		$this->logsStd = $logsStandart;
	}

	public function compute($logs)
	{
		$this->checkLogs($logs);

		$soldUnits = $this->splitLogs($this->logsStd->getEntryDelimiter(), $logs);
		$entriesNames = array();
		$entriesSums = array();

		foreach ($soldUnits as $unit) {
			$splitedUnit  = $this->splitLogs($this->logsStd->getItemDelimiter(), $unit);

			array_push($entriesNames, $splitedUnit[0]);
			array_push($entriesSums, $splitedUnit[1]);
		}

		return array($entriesNames, $entriesSums);
	}

	/**
	* @param string $logs
	* @return void
	*/
	private function checkLogs($logs)
	{
		if (
			!is_string($logs)
				||
			strlen($logs) < 4
		) {
			throw new BookKeepingException('Логи должны храниться в строке не менее 4 символов.');
		}
	}

	/**
	* @param string $delimiter
	* @param string $logs
	* @return array
	*/
	private function splitLogs($delimiter, $logs)
	{
		$splitedLogs = array_filter(explode($delimiter, $logs), 'strlen');

		if (count($splitedLogs) < 2) {
			throw new BookKeepingException(
				"Неверный формат логов. Возможно упущен символ '$delimiter'."
			);
		} elseif ($delimiter == $this->logsStd->getItemDelimiter() && count($splitedLogs) != 2) {
			throw new BookKeepingException(
				"Неверный формат логов. Возможно упущен символ '"
				. $this->logsStd->getEntryDelimiter()
				. "'."
			);
		}

		return $splitedLogs;
	}
}