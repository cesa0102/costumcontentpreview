<?php

namespace Mdy\Costumcontentpreview\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class CropTableViewHelper
 *
 * @package Mdy\Costumcontentpreview\ViewHelpers
 */
class CropTableViewHelper extends AbstractViewHelper {

    /**
     * Arguments Initialization
     */
    public function initializeArguments() {
        $this->registerArgument(
                'content', 'string', 'content to be used inside viewhelper. E.g. bodytext', FALSE
        );

        $this->registerArgument(
                'amountOfRows', 'int', 'amount of lines', FALSE
        );
    }

    /**
     * @param string $content
     * @return string
     */
    public function render() {
        $output = "";
        $rowsToShow = intval($this->arguments['amountOfRows']);

        if ($this->arguments['content'] && $rowsToShow > 0) {
            $arrayContentByRows = explode("\n", $this->arguments['content']);
            $originalAmoutOfRows = count($arrayContentByRows);
            $arrayContentByRows = array_splice($arrayContentByRows, 0, $rowsToShow);
            
            $output = '<table class="ccpTableWrap">';

            foreach ($arrayContentByRows as $singleRow) {
                $arrayTableByCells = explode("|", $singleRow);    
                $singleLine = "";

                foreach ($arrayTableByCells as $singleCell) {
                    $singleLine .= '<td class="ccpTableTd">'.$singleCell.'</td>';
                }
                
                $output .= '<tr>'.$singleLine.'</tr>';
            }
            
            $output .= '</table>';

            if ($originalAmoutOfRows > $rowsToShow) {
                $output .= '<div>...</div>';
            }
        }

        return $output;
    }

}
