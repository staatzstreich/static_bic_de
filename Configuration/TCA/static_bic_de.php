<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
	'ctrl' => array (
		'title' => 'LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde',
		'label' => 'bank_name',
		'readOnly' => 1,
		'rootLevel' => 1,
		'is_static' => 1,
		'default_sortby' => 'ORDER BY bank_ic',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('static_info_tables_bic_de') . 'icon_static_bic.gif',
	),
	'interface' => array (
		'showRecordFieldList' => 'bank_ic, bank_name'
	),
	'searchFields' => 'bank_ic,bank_name',
	'columns' => array (
		'bank_ic' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde.bank_ic',
			'config' => array (
				'type' => 'input',
				'size' => '8',
				'max' => '8',
				'eval' => 'double',
				'default' => 0
			)
		),
		'bank_name' => array (
			'exclude' => 0,
			'label' => 'LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde.bank_name',
			'config' => array (
				'type' => 'input',
				'size' => '60',
				'max' => '127'
			)
		)
	),
	'types' => array (
		'0' => array(
			'showitem' => 'bank_ic, bank_name'
		)
	),
	'palettes'	=> array (
		'1' => array(
			'showitem' => 'bank_ic,bank_name', 'canNotCollapse' => '1'
		)
	)
);