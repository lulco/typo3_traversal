<?php

require_once (PATH_typo3 . 'interfaces/interface.backend_cacheActionsHook.php');

class tx_Traversal_CacheMenu_Recalculating implements backend_cacheActionsHook
{
	/**
	 * Add item to menu
	 * 
	 * @param mixed &$cacheActions
	 * @param mixed &$optionValues
	 * @see backend_cacheActionsHook::manipulateCacheActions()
	 * @return void
	 */
	public function manipulateCacheActions(&$cacheActions, &$optionValues)
	{
		$cacheActions[] = array(
			'id' => 'traversal_recalculate',
			'title' => 'Recalculate page tree',
			'href' => 'ajax.php?ajaxID=traversal::recalculate',
			'icon' => '<img src="../typo3conf/ext/traversal/Resources/Public/Icons/tree.gif" width="16" height="16" title="Recalculate page tree" alt="Recalculate page tree">',
		);
		$optionValues[] = 'traversal_recalculate';
	}
}