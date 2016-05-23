<?php
defined('TYPO3_MODE') or die();

$extraContentTab = "
,--div--;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tabs.infobox,
--palette--;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tabs.infobox;tabAdditionalRTE
";

$additionalColumns = array(
        'headerLinkCheck' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.headerLinkCheck',
		'config' => array(
			'type' => 'check',
		)
        ),
        'headerLinkText' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.headerLinkText',
		'config' => array(
			'type' => 'input',
			'size' => '30',
			'eval' => 'trim',
		)
        ),
        'geoLatitude' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.geoLatitude',
		'config' => array(
			'type' => 'input',
			'size' => '10',
			'eval' => 'trim',
		)
        ),
        'geoLongtitude' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.geoLongtitude',
		'config' => array(
			'type' => 'input',
			'size' => '10',
			'eval' => 'trim',
		)
        ),
        'youtubeId' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.youtubeId',
		'config' => array(
			'type' => 'input',
			'size' => '10',
			'eval' => 'trim',
		)
        ),
	'tabHeadline' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.tabHeadline',
		'config' => array(
			'type' => 'input',
			'size' => '30',
			'max' => '255',
		)
	),
	'tabBodytext' => array(
		'exclude' => 0,
		'label' => 'LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.tabBodytext',
		'config' => array(
			'type' => 'text',
			'cols' => 40,
			'rows' => 6,
			'softref' => 'typolink_tag,images,email[subst],url',
		),
		'defaultExtras' => 'richtext[]:rte_transform[mode=tx_examples_transformation-ts_css]'
	),
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalColumns);

$GLOBALS['TCA']['tt_content']['palettes']['tabAdditionalRTE']['showitem'] = '
tabHeadline;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.tabHeadline,
--linebreak--,
tabBodytext;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.tabBodytext
';

$GLOBALS['TCA']['tt_content']['columns']['header_link']['config']['size'] = 18;

$GLOBALS['TCA']['tt_content']['palettes']['header']['showitem'] = '
header;LLL:EXT:cms/locallang_ttc.xlf:header_formlabel,
--linebreak--,
subheader;LLL:EXT:cms/locallang_ttc.xlf:subheader_formlabel,
--linebreak--,
header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
header_position;LLL:EXT:cms/locallang_ttc.xlf:header_position_formlabel,
date;LLL:EXT:cms/locallang_ttc.xlf:date_formlabel,
--linebreak--,
header_link;LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel,
headerLinkText;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.headerLinkText,
headerLinkCheck;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.headerLinkCheck,
--linebreak--,
youtubeId;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.youtubeId,
geoLatitude;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.geoLatitude,
geoLongtitude;LLL:EXT:seo_fields/Resources/Private/Language/db.xml:tt_content.geoLongtitude,
';

$GLOBALS['TCA']['tt_content']['types']['text']['showitem'] .= $extraContentTab;

$GLOBALS['TCA']['tt_content']['types']['textpic']['showitem'] .= $extraContentTab;

$GLOBALS['TCA']['tt_content']['types']['textmedia']['showitem'] .= $extraContentTab;

$GLOBALS['TCA']['tt_content']['types']['html']['showitem'] = '
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.html_formlabel,
header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
bodytext;LLL:EXT:cms/locallang_ttc.xlf:bodytext.ALT.html_formlabel;;nowrap:wizards[t3editor],
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category, categories
';

$GLOBALS['TCA']['tt_content']['types']['shortcut']['showitem'] = '
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.general;general,
header;LLL:EXT:cms/locallang_ttc.xlf:header.ALT.shortcut_formlabel,
header_layout;LLL:EXT:cms/locallang_ttc.xlf:header_layout_formlabel,
records;LLL:EXT:cms/locallang_ttc.xlf:records_formlabel,
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.frames;frames,
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.visibility;visibility,
--palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access,
--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended,
--div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category, categories
';
