<?php

namespace Mdy\Costumcontentpreview\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

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
    }

    private function splitNewLine($text)
    {
        $code = preg_replace('/\n$/', '', preg_replace('/^\n/', '', preg_replace('/[\r\n]+/', "\n", $text)));
        return explode("\n", $code);
    }

    /**
     * @return string $output
     */
    public function render()
    {
        $content = $this->arguments['content'];
        $linesToCrop = intval($this->arguments['linesToCrop']);
        $explodeRows = $this->arguments['explodeRows'];
        $explodeItems = $this->arguments['explodeItems'];
        $itemWrap = $this->arguments['itemWrap'];
        $lineWrap = $this->arguments['lineWrap'];
        $contentWrap = $this->arguments['contentWrap'];
        $output = "";

        /* @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObject */
        $cObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

        if ($content && $linesToCrop > 0) {
            if ($exlodeRows) {
                $contentLines = explode($explodeRows, $content);
            } else {
                $contentLines = $this->splitNewLine($content);
            }

            $contentAmoutOfLines = count($contentLines);
            $croppedContentLines = array_splice($contentLines, 0, $linesToCrop);

            foreach ($croppedContentLines as $singleLine) {
                if ($explodeItems) {
                    $contentRowItems = explode($explodeItems, $singleLine);
                    $newSingleLine = "";
                    foreach ($contentRowItems as $singleItem) {
                        $newSingleLine .= $cObject->wrap($singleItem, $itemWrap);
                    }

                    if ($lineWrap) {
                        $output .= $cObject->wrap($newSingleLine, $lineWrap);
                    } else {
                        $output .= $singleLine . "\n";
                    }
                } elseif (strpos($singleLine, '|') !== false && !$explodeItems) {
                    $contentWrap = '<dl class="ccpDlWrap">|</dl>';
                    $contentRowItems = explode("|", $singleLine);
                    $newSingleLine = "";
                    foreach ($contentRowItems as $i => $singleItem) {
                        if ($i % 2 == 0) {
                            $output .= $cObject->wrap($singleItem, "<dt>|</dt>");
                        } else {
                            $output .= $cObject->wrap($singleItem, "<dd>|</dd>");
                        }
                    }
                } else {
                    if ($lineWrap) {
                        $output .= $cObject->wrap($singleLine, $lineWrap);
                    } else {
                        $output .= $singleLine . "\n";
                    }
                }
            }

            $output = $cObject->wrap($output, $contentWrap);

            if ($contentAmoutOfLines > $linesToCrop) {
                $output .= "...";
            }
        }

        return $output;
    }

}
