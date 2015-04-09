<?php

class tx_Traversal_PageTree
{
	/**
	 * @var array
	 */
	protected $treeStruct = array();
	
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
			$this->prepareTreeStruct();
			$this->computeStructureRecursive();
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
		if ($table == 'pages' && in_array($command, array('move', 'copy', 'delete', 'undelete'))) {
			$this->prepareTreeStruct();
			$this->computeStructureRecursive();
		}
	}
	
	/**
	 * Prepares the array(pid => array(uid)) - parent => children structure
	 * 
	 * @return void
	 */
	private function prepareTreeStruct()
	{
		$struct = array();

		$sql = "SELECT p1.uid, p1.pid, p1.sorting FROM pages AS p1 LEFT JOIN pages AS p2 on p1.pid = p2.uid";
		$res = $GLOBALS['TYPO3_DB']->sql_query($sql);
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			if (!isset($struct[(int)$row['pid']][(int)$row['sorting']])) {
				$struct[(int)$row['pid']][(int)$row['sorting']] = $row['uid'];
			} else {
				$struct[(int)$row['pid']][] = $row['uid'];
			}
		}
		$GLOBALS['TYPO3_DB']->sql_free_result($res);
		$this->treeStruct = $struct;
	}

	/**
	 * Update the super-awesome page tree structure when all pages are preloaded - use this for updating of the whole tree
	 * 
	 * @param int $uid
	 * @param int $value
	 * @param int $depth
	 * @return int
	 * @recursive
	 */
	private function computeStructureRecursive($uid = 0, $value = 0, $depth = 0)
	{
		$lft = $value + 1;
		if (isset($this->treeStruct[$uid])) {
			ksort($this->treeStruct[$uid]);
			foreach ($this->treeStruct[$uid] as $subUid) {
				$value = $this->computeStructureRecursive($subUid, $value + 1, $depth + 1);
			}
		}

		$rgt = $value + 2;
		
		$sql = "UPDATE pages SET lft = $lft, rgt = $rgt, depth = $depth WHERE uid = $uid";
		$GLOBALS['TYPO3_DB']->sql_query($sql);
		
		return $value + 1;
	}
}