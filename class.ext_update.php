<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2008 Tom Rüther (tr@e-netconsulting.de)
*  (c) 2009 Michael Staatz (micsta@e-netconsulting.de)
*  All rights reserved
*
*  This script is part of the Typo3 project. The Typo3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

define('theCSVFile', PATH_typo3conf . 'ext/static_info_tables_bic_de/' . 'new_bic_file.csv');

/**
 * Class for updating the db
 *
 *
 * @author	Tom Rüther <tr@e-netconsulting.de>
 * @author	Michael Staatz <micsta@e-netconsulting.de>
 * @author	Karsten Dambekalns <karsten@typo3.org>
 *
 * @see http://www.bundesbank.de/zahlungsverkehr/zahlungsverkehr_bankleitzahlen_download.php
 * for new updates. Download the EXCEL-File and convert it to CSV-File with ';' as delimiter
 */
class ext_update  {

	protected $tempFile = theCSVFile;

	/**
	 * Main function, returning the HTML content of the module
	 *
	 * @return string HTML
	 */
	function main()	{
		$content = '<br />Update tables.';
		$content .= '<br />Get EXCEL-File from: http://www.bundesbank.de/zahlungsverkehr/zahlungsverkehr_bankleitzahlen_download.php';
		$content .= '<br />export it to CSV-File and upload it here.';

		if(t3lib_div::_GP('update')) {
			if (move_uploaded_file($_FILES['fimport']['tmp_name'], $this->tempFile)) {
				if(t3lib_div::_GP('debug') === 'show') {
					$content .= '<div class="bgColor5" style="padding:10px; border:1px solid green;">' . $this->updateTable('show') . '</div>';
				} elseif(t3lib_div::_GP('debug') === 'preview') {
					$content .= '<div class="bgColor5" style="padding:10px; border:1px solid red;">' . $this->updateTable('preview') . '</div>';
				} else {
					$content .= '<p>' . $this->updateTable('') . '</p>';
				}
			} else {
				$content .= '<div class="bgColor5" style="padding:10px; border:1px solid red;">Error: Can not create temporary file in Extensionfolder!!!</div>';
			}
			$content .= '<div class="bgColor5" style="padding:10px; border:1px solid green;">Done</div>';
			$content .= '<p><a class="typo3-goBack" href="javascript:history.back()"><img width="16" height="16" alt="" class="absmiddle" src="../../../sysext/t3skin/icons/gfx/goback.gif"/>back to form</a></p>';
		} else {
			$content .= '</form>';
			$content .= '<form action="' . htmlspecialchars(t3lib_div::linkThisScript()) . '" method="post" enctype="multipart/form-data">';
			$content .= '<br /><br />';
			$content .= '<input type="file" name="fimport">';
			$content .= '<br /><br />';
			$content .= '<input type="radio" name="debug" value="show"/>&nbsp;Show SQL statement after finish';
			$content .= '<br /><br />';
			$content .= '<input type="radio" name="debug" value="preview"/>&nbsp;only Preview SQL statement';
			$content .= '<br /><br />';
			$content .= '<input type="submit" name="update" value="Update" />';
			$content .= '</form>';
		}

		return $content;
	}

	/**
	 * access is always allowed
	 *
	 * @return boolean Always returns true
	 */
	function access() {
		return true;
	}

	/**
	 * update Table
	 *
	 * @return string SQL-String
	 */
	 function updateTable($mode) {
		$handle = fopen($this->tempFile, 'r');
		if (!$handle) {
			return 'Can not open file: ' . $this->tempFile;
		}

		$count = 0;
		$rows = '';

			// check if we get the org. header - @TODO better file validation
		$data = fgetcsv($handle, 1024, ';');
		if ($data[0] != 'Bankleitzahl') {
			if (file_exists($this->tempFile)) {
				unlink($this->tempFile);
			}
			return 'The uploaded file is not a valid CSV file!';
		}
		unset($data);

		while (($data = fgetcsv($handle, 1024, ';')) !== FALSE) {
			$count++;
			if ($data[1] === '1') {
				$rows[] = 'INSERT INTO static_bic_de (uid, pid, bank_ic, bank_name) VALUES (' . $count . ', 0, \'' . $data[0] . '\', \'' . $data[2] . '\')';
			}
		}

		fclose($handle);
		if (file_exists($this->tempFile)) {
			unlink($this->tempFile);
		}

		$deleteQuery = "DELETE FROM static_bic_de";

	 	if($mode === 'show') {
	 		$GLOBALS['TYPO3_DB']->sql_query($deleteQuery);
			foreach ($rows as $row) {
				$GLOBALS['TYPO3_DB']->sql_query($row);
			}
			$res = $deleteQuery . '<br />';
			$res .= implode('<br />', $rows);
		} elseif($mode === 'preview') {
			$res = $deleteQuery . '<br />';
			$res .= implode('<br />', $rows);
		} else {
			$GLOBALS['TYPO3_DB']->sql_query($deleteQuery);
			foreach ($rows as $row) {
				$GLOBALS['TYPO3_DB']->sql_query($row);
			}
			$res = '';
		}

		return($res);
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/static_info_tables_bic_de/class.ext_update.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/static_info_tables_bic_de/class.ext_update.php']);
}

?>