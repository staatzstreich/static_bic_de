<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$TCA["static_bic_de"] = Array (
    "ctrl" => Array (
        "title" => "LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde",
        "label" => "bank_name",
		"readOnly" => 1,	// This should always be true, as it prevents the static data from being altered
		"rootLevel" => 1,
		"is_static" => 1,
		"default_sortby" => "ORDER BY bank_ic",
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
        "iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_static_bic.gif",
    ),
    "feInterface" => Array (
        "fe_admin_fieldList" => "bank_ic, bank_name",
    )
);

?>
