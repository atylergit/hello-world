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
    function __construct(ConfigObj $configObj, AuthenticationObj $authenticationObj)
    {
        $this->configObj = $configObj;
        $this->authenticationObj = $authenticationObj;
        $this->authenticationObj->CheckSession();
    }

    function __destruct()
    {
    }


    public $views;

    public function LoadTemplateFile($templateName)
    {
        $templateFileName = $this->configObj->templatePath . '/' . $templateName . '.html';
        if (!$this->CheckTemplateFileExists($templateFileName)) {
            throw new Exception("Template file does not exist {$templateFileName}");
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

    public function AddLoopContent($loopKey, $array, $type, $tag, $br = false, $class = '', $count = null)
    {
        $loopContent = '';
        $type        = strtolower($type);
        switch ($type) {
            case 'for':
                if (is_null($count) || !is_int($count)) {
                    $count = count($array);
                }
                for ($i = 0; $i < $count; $i++) {
                    if ($tag == 'a') {
                        $loopContent .= "<{$tag} href='{$array[$i]}' class='{$class}' id='{$array[$i]}'>{$array[$i]}</{$tag}>" . ($br == true ? '</br>' : '');
                    } else {
                        $loopContent .= "<{$tag} class='{$class}' id='{$array[$i]}'>{$array[$i]}</{$tag}>" . ($br == true ? '</br>' : '');
                    }
                }
                break;
            case 'foreach':
                foreach ($array as $key => $value) {
                    if ($tag == 'a') {
                        $loopContent .= "<{$tag} href='{$key}' class='{$class}' id='{$key}'>{$value}</{$tag}>" . ($br == true ? '</br>' : '');
                    } else {
                        $loopContent .= "<{$tag} class='{$class}' id='{$key}'>{$value}</{$tag}>" . ($br == true ? '</br>' : '');
                    }
                }
                break;
            default:
                throw new Exception('Type not given or not valid for method, Invalid Parameter');
                break;
        }
        $this->AddTemplateVariable($loopKey, $loopContent);
    }

    public function GetViewsList() {
        $views = array();
        $excludePaths = array('..', '.');
        foreach (scandir($this->configObj->templatePath . '/Views') as $rawView) {
            if (in_array($rawView, $excludePaths)) {
                continue;
            }
            $views[$rawView] = $this->configObj->templatePath . '/Views/' . $rawView;
        }
        $views['Default'] = $this->configObj->templatePath . '/Views/' . 'Home';

        $this->views = $views;
    }

    public function GetViewRequest() {
        if (!isset($_GET['page'])) {
            $_GET['page'] = 'Home';
        }

        $view = $_GET['page'];

        return $view;
    }

    private $template;

    private $configObj;

    private $authenticationObj;

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