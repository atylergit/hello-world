<?php

/*****************************************************************************************
 * @name...........: TemplateLoaderObj
 * @class..........: TemplateLoaderObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 04/26/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class TemplateLoaderObj
{
    function __construct(ConfigObj $configObj)
    {
        $this->configObj = $configObj;
    }

    function __destruct()
    {
    }

    public function GetTemplate($templateName)
    {
        $templateFileName = $this->configObj->templatePath . $templateName . '.html';
        if (!$this->CheckTemplateFileExists($templateFileName)) {
            throw new Exception('Template file does not exist');
        }

        $this->GetTemplateAsString($templateFileName);
        $this->DoStringReplacements();

        return $this->template;
    }

    public function AddTemplateVariable($variableName, $value)
    {
        if (!isset($this->replacements)) {
            $this->replacements = array();
        }
        $this->replacements["{$variableName}"] = $value;
    }

    public function AddLoopContent($loopKey, $array, $type, $tag, $br = false, $count = null)
    {
        $loopContent = '';
        $type        = strtolower($type);
        switch ($type) {
            case 'for':
                if (is_null($count) || !is_int($count)) {
                    $count = count($array);
                }
                for ($i = 0; $i < $count; $i++) {
                    $loopContent .= "<{$tag} id='$array[$i]'>{$array[$i]}</{$tag}>" . ($br == true ? '</br>' : '');
                }
                break;
            case 'foreach':
                foreach ($array as $key => $value) {
                    $loopContent .= "<{$tag} id='{$key}'>{$value}</{$tag}>" . ($br == true ? '</br>' : '');
                }
                break;
            default:
                throw new Exception('Type not given or not valid for method, Invalid Parameter');
                break;
        }
        $this->AddTemplateVariable($loopKey, $loopContent);
    }

    private $template;

    private $configObj;

    private $replacements;

    private function CheckTemplateFileExists($templateFileName)
    {
        $itExists = false;

        if (file_exists($templateFileName)) {
            $itExists = true;
        }

        return $itExists;
    }

    private function GetTemplateAsString($templateFileName)
    {
        $templateStr    = file_get_contents($templateFileName);
        $this->template = $templateStr;
    }

    private function DoStringReplacements()
    {
        foreach ($this->replacements as $key => $value) {
            $this->template = str_replace("@=@{$key}@=@", $value, $this->template);
        }
    }
}