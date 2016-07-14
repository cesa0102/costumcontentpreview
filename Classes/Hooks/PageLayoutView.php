<?php

namespace Mdy\Costumcontentpreview\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;

class PageLayoutView implements \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface
{
    /**
     * Preprocesses the preview rendering of a content element.
     *
     * @param PageLayoutView $parentObject Calling parent object
     * @param boolean $drawItem Whether to draw the item using the default functionalities
     * @param string $headerContent Header content
     * @param string $itemContent Item content
     * @param array $row Record row of tt_content
     * @return void
     */
    public function preProcess(\TYPO3\CMS\Backend\View\PageLayoutView &$parentObject, &$drawItem, &$headerContent, &$itemContent, array &$row)
    {
        $drawItem = FALSE;

        /* @var \Mdy\Costumcontentpreview\Render\RenderPreviews $RenderPreviews */
        $RenderPreviews = GeneralUtility::makeInstance('Mdy\Costumcontentpreview\Render\RenderPreviews');

        switch ($row['CType']) {
            case "html":
                $headerContent = '<b>' . PageLayoutView::cropHeader($row['header'], $row['bodytext']) . '</b><br>';
                $itemContent = $RenderPreviews->output(
                    $row['bodytext'],
                    [
                        'linesToCrop' => 9,
                        'contentWrap' => '<pre class="ccpPreWrap">|</pre>',
                        'enableHtmlSpecialChars' => true
                    ]
                );

                break;
            case "table":
                $headerContent = '<b>' . PageLayoutView::cropHeader($row['header'], $row['bodytext']) . '</b><br>';
                $itemContent = $RenderPreviews->output(
                    $row['bodytext'],
                    [
                        'linesToCrop' => 6,
                        'contentWrap' => '<table class="ccpTableWrap">|</table>',
                        'lineWrap' => '<tr>|</tr>',
                        'itemWrap' => '<td class="ccpTableTd">|</td>',
                        'explodeItems' => '|'
                    ]
                );

                break;
            case "bullets":
                $headerContent = '<b>' . PageLayoutView::cropHeader($row['header'], $row['bodytext']) . '</b><br>';
                $itemContent = $RenderPreviews->output(
                    $row['bodytext'],
                    [
                        'linesToCrop' => 5,
                        'contentWrap' => '<ul class="ccpUlWrap">|</ul>',
                        'lineWrap' => '<li>|</li>'
                    ]
                );

                break;
        }
    }

    public function cropHeader($header, $bodytext)
    {
        if ($header == '' && $bodytext != '') {
            /* @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $cObject */
            $cObject = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');
            //$croppedHeader = $cObject->stdWrap_cropHTML($bodytext,'120 | ... | 1');

            $max_length = 120;
            $strippedBodytext = $cObject->stdWrap_stripHtml($bodytext);

            if (strlen($strippedBodytext) > $max_length) {
                $offset = ($max_length - 3) - strlen($strippedBodytext);
                $croppedHeader = substr($strippedBodytext, 0, strrpos($strippedBodytext, ' ', $offset)) . '...';

                return $croppedHeader;
            } else {
                return $strippedBodytext;
            }

        } else {
            return $header;
        }
    }
}