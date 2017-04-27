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
        $this->configObj;
    }

    function __destruct()
    {
    }

    public function GetTemplate($templateName)
    {
        $templateFileName = $templateName . '.html';
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

    private $template;

    private $configObj;

    private $replacements;

    private function CheckTemplateFileExists($templateFileName)
    {
        $itExists = false;

        if (file_exists($this->configObj->templatePath . $templateFileName)) {
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