<?php

if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][]  = 'EXT:' . $_EXTKEY . '/Classes/PageTree.php:&tx_Traversal_PageTree';
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processCmdmapClass'][]  = 'EXT:' . $_EXTKEY . '/Classes/PageTree.php:&tx_Traversal_PageTree';