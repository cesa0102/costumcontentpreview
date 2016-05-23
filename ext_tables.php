<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$GLOBALS['TBE_STYLES']['skins']['costumcontentpreview'] = array(
    'name' => 'costumcontentpreview',
    'stylesheetDirectories' => array(
        'css' => 'EXT:costumcontentpreview/Resources/Public/Css/typo3_backend/'
    )
);


\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
mod {
    web_layout {
        tt_content {
            preview {
                html = EXT:costumcontentpreview/Resources/Private/Templates/Html.html
                bullets = EXT:costumcontentpreview/Resources/Private/Templates/Bullets.html
                table = EXT:costumcontentpreview/Resources/Private/Templates/Table.html
            }
        }
    }
}
');
