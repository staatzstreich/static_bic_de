<?php

###############################################################################
# Extension Manager/Repository config file for ext "static_info_tables_bic_de".
###############################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Static info tables - German Bank Identifier Codes',
	'description' => 'Database with german bank identifier codes and the associated bank names and Swiftcodes.',
	'version' => '1.3.1',
	'category' => 'misc',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-10.9.99'
		),
		'conflicts' => array(
		),
		'suggest' => array(
		)
	),
	'state' => 'stable',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'author' => 'Michael Staatz',
	'author_email' => 'kontakt@mstaatz.de',
	'author_company' => '',
	'autoload' => '',
);

?>