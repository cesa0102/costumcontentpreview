<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS
['TYPO3_CONF_VARS']
['SC_OPTIONS']
['cms/layout/class.tx_cms_layout.php']
['tt_content_drawItem']
['costumcontentpreview'] = 'EXT:costumcontentpreview/Classes/Hooks/PageLayoutView.php:Mdy\costumcontentpreview\Hooks\PageLayoutView';

$GLOBALS
['TBE_STYLES']
['skins']
['costumcontentpreview'] = array(
    'name' => 'costumcontentpreview',
    'stylesheetDirectories' => array(
        'css' => 'EXT:costumcontentpreview/Resources/Public/Css/typo3_backend/'
    )
);