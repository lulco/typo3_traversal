<?php

class tx_Traversal_Hook
{
	/**
	 * hook after all database operations
	 * 
	 * @param	string	$status		(new|update)
	 * @param	string	$table
	 * @param	int		$id
	 * @param	array	&$fieldArray
	 * @param	object	&$object
	 * @return	void
	 */
	public function processDatamap_afterDatabaseOperations($status, $table, $id, &$fieldArray, t3lib_TCEmain &$object)
	{
		if ($table === "pages") {
			Tx_Traversal_PageTree::recalculate();
		}
	}
	
	/**
	 * hook after BE db command 
	 * 
	 * @param string $command
	 * @param string $table
	 * @param string $id
	 * @param string $value
	 * @param t3lib_TCEmain $tcemain
	 * @return void
	 */
	public function processCmdmap_postProcess($command, $table, $id, $value, t3lib_TCEmain $tcemain)
	{
		if ($table == 'pages' && in_array($command, array('move', 'delete', 'undelete'))) {
			Tx_Traversal_PageTree::recalculate();
		}
	}
}