<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");


$TCA["static_bic_de"] = Array (
    "ctrl" => $TCA["static_bic_de"]["ctrl"],
    "interface" => Array (
        "showRecordFieldList" => "bank_ic, bank_name"
    ),
    "feInterface" => $TCA["static_bic_de"]["feInterface"],
    "columns" => Array (
        "bank_ic" => Array (        
            "exclude" => 0,
            "label" => "LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde.bank_ic",
            "config" => Array (
                "type" => "input",    
                "size" => "8",
                "max" => "8",
                "eval" => "double",
                "default" => 0
            )
        ),
        "bank_name" => Array (        
            "exclude" => 0,        
            "label" => "LLL:EXT:static_info_tables_bic_de/locallang_db.php:tx_staticinfotablesbicde.bank_name",
            "config" => Array (
                "type" => "input",    
                "size" => "60",    
                "max" => "127"
            )
        )
    ),
    "types" => Array (
        "0" => Array(
			"showitem" => "bank_ic;;;;1-1-1, bank_name"
      )
   ),
   "palettes"	=> Array (
		"1" => Array(
			"showitem" => "bank_ic,bank_name", "canNotCollapse" => "1"
		)
	)
);

?>
