<?php

class Tx_Traversal_PageTree
{
	/**
	 * @var array
	 */
	private static $treeStruct = array();
	
	/**
	 * recalculate lft, rgt and depth for all pages in page tree
	 */
	public static function recalculate()
	{
		self::prepareTreeStruct();
		self::computeStructureRecursive();
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
		self::$treeStruct = $struct;
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
		if (isset(self::$treeStruct[$uid])) {
			ksort(self::$treeStruct[$uid]);
			foreach (self::$treeStruct[$uid] as $subUid) {
				$value = self::computeStructureRecursive($subUid, $value + 1, $depth + 1);
			}
		}

		$rgt = $value + 2;
		
		$sql = "UPDATE pages SET lft = $lft, rgt = $rgt, depth = $depth WHERE uid = $uid";
		$GLOBALS['TYPO3_DB']->sql_query($sql);
		
		return $value + 1;
	}
}