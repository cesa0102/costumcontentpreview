<?php

namespace Mdy\Costumcontentpreview\Render;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class RenderPreviews
{
    private function splitNewLine($text)
    {
        $code = preg_replace('/\n$/', '', preg_replace('/^\n/', '', preg_replace('/[\r\n]+/', "\n", $text)));
        return explode("\n", $code);
    }

    public function output($content,$outputConfig)
    {
        $linesToCrop = intval($outputConfig['linesToCrop']);
        $explodeRows = $outputConfig['explodeRows'];
        $explodeItems = $outputConfig['explodeItems'];
        $itemWrap = $outputConfig['itemWrap'];
        $lineWrap = $outputConfig['lineWrap'];
        $contentWrap = $outputConfig['contentWrap'];
        $enableHtmlSpecialChars = $outputConfig['enableHtmlSpecialChars'];
        $output = "";

        /* @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObject */
        $cObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

        if ($content && $linesToCrop > 0) {
            if ($explodeRows) {
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
                            $output .= $cObject->wrap($singleItem, '<dt class="ccpDtItem">|</dt>');
                        } else {
                            $output .= $cObject->wrap($singleItem, '<dd class="ccpDdItem">|</dd>');
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

            if ($enableHtmlSpecialChars === true) {
                $output = $cObject->wrap(htmlspecialchars($output, ENT_QUOTES), $contentWrap);
            }
            else {
                $output = $cObject->wrap($output, $contentWrap);
            }

            if ($contentAmoutOfLines > $linesToCrop) {
                $output .= "...";
            }
        }

        return $output;
    }
}