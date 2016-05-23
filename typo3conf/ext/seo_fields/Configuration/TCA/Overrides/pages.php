<?php
defined('TYPO3_MODE') or die();

$additionalColumns = array(
	'h2Headline' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:pages.h2Headline',
		'config' => array(
			'type' => 'input',
			'size' => 70,
			'eval' => 'trim'
		)
	),
	'titleSuffixCheck' => array(
		'exclude' => 1,
		'label'   => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:pages.titleSuffixCheck',
		'config'  => array(
			'type' => 'check',
		)
	)
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $additionalColumns);

$GLOBALS['TCA']['pages']['palettes']['title']['showitem'] .= '
,
--linebreak--,
h2Headline;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:pages.h2Headline,
--linebreak--,
titleSuffixCheck;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:pages.titleSuffixCheck
';
