<?php

namespace Mdy\Costumcontentpreview\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Class CropOutputByLinesViewHelper
 *
 * @package Mdy\Costumcontentpreview\ViewHelpers
 */
class CropOutputByLinesViewHelper extends AbstractViewHelper {

    /**
     * Arguments Initialization
     */
    public function initializeArguments() {
        $this->registerArgument(
                'content', 'string', 'content to be used inside viewhelper. E.g. bodytext', FALSE
        );

        $this->registerArgument(
                'amountOfLines', 'int', 'amount of lines', FALSE
        );

        $this->registerArgument(
                'lineWrap', 'string', 'a wrap that will pear around each line', FALSE
        );        
    }
    
    /**
     * @param string $content
     * @return string
     */
    public function render() {
        $linesToShow = intval($this->arguments['amountOfLines']);

        if ($this->arguments['content'] && $linesToShow > 0) {
            $arrayContentByLines = explode("\n", $this->arguments['content']);
            $originalAmoutOfLines = count($arrayContentByLines);

            $arrayContentByLines = array_splice($arrayContentByLines, 0, $linesToShow);
            
            foreach ($arrayContentByLines as $singleLine) {
                if ($this->arguments['lineWrap'] && strpos($this->arguments['lineWrap'], "|") !== false) {
                    $singleLine = str_replace("|", $singleLine, $this->arguments['lineWrap']);
                }
                
                

                $output .= $singleLine;
            }
                
            if ($originalAmoutOfLines > $linesToShow) {
                $output .= "...";
            }
        }

        return $output;
    }

}
