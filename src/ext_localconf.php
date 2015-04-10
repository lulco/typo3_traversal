<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][]  = 'EXT:' . $_EXTKEY . '/Classes/PageTree.php:&tx_Traversal_Hook';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][]  = 'EXT:' . $_EXTKEY . '/Classes/PageTree.php:&tx_Traversal_Hook';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['additionalBackendItems']['cacheActions'][$_EXTKEY] = 'EXT:' . $_EXTKEY . '/Classes/CacheMenu/Recalculating.php:&tx_Traversal_CacheMenu_Recalculating';
$GLOBALS['TYPO3_CONF_VARS']['BE']['AJAX']['traversal::recalculate'] = 'EXT:' . $_EXTKEY . '/Classes/PageTree.php:&Tx_Traversal_PageTree->recalculate';

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Tx_Traversal_Scheduler_PageTreeRecalculateScheduler'] = array(
    'extension'        => $_EXTKEY,
    'title'            => 'Recalculate page tree',
    'description'      => 'Scheduler for recalculating columns lft, rgt and depth for all pages in page tree ',
);