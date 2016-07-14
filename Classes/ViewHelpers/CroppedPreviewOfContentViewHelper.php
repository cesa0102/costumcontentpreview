<?php

namespace Mdy\Costumcontentpreview\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class CroppedPreviewOfContentViewHelper
 *
 * @package Mdy\Costumcontentpreview\ViewHelpers
 */
class CroppedPreviewOfContentViewHelper extends AbstractViewHelper
{

    /**
     * Arguments Initialization
     */
    public function initializeArguments()
    {
        $this->registerArgument(
            'content', 'string', 'content to be used inside viewhelper. E.g. bodytext', TRUE
        );

        $this->registerArgument(
            'linesToCrop', 'int', 'amount of lines', FALSE, 3
        );

        $this->registerArgument(
            'explodeRows', 'string', 'string to split content', FALSE
        );

        $this->registerArgument(
            'explodeItems', 'string', 'string to split lines', FALSE
        );

        $this->registerArgument(
            'itemWrap', 'string', 'a wrap that will pear around each item', FALSE
        );

        $this->registerArgument(
            'lineWrap', 'string', 'a wrap that will pear around each line', FALSE
        );

        $this->registerArgument(
            'contentWrap', 'string', 'a wrap that will pear around the complete output', FALSE, "|"
        );

        $this->registerArgument(
            'enableHtmlSpecialChars', 'boolean', 'Switch to enable enableHtmlSpecialChars for each line', FALSE, FALSE
        );
    }

    /**
     * @return string $output
     */
    public function render()
    {
        /* @var \Mdy\Costumcontentpreview\Render\RenderPreviews $RenderPreviews */
        $RenderPreviews = GeneralUtility::makeInstance('Mdy\Costumcontentpreview\Render\RenderPreviews');

        $output = $RenderPreviews->output(
            $this->arguments['content'],
            [
                'linesToCrop' => intval($this->arguments['linesToCrop']),
                'explodeRows' => $this->arguments['explodeRows'],
                'explodeItems' => $this->arguments['explodeItems'],
                'itemWrap' => $this->arguments['itemWrap'],
                'lineWrap' => $this->arguments['lineWrap'],
                'contentWrap' => $this->arguments['contentWrap'],
                'enableHtmlSpecialChars' => $this->arguments['enableHtmlSpecialChars']
            ]
        );

        return $output;
    }

}
