<?php

/*****************************************************************************************
 * @name...........: ViewDefaultBaseControllerObjAbs
 * @class..........: ViewDefaultBaseControllerObjAbs
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 05/12/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
abstract class ViewDefaultBaseControllerObjAbs
{
    function __construct(TemplateLoaderObj $templateLoaderObj, ConfigObj $configObj)
    {
        $this->templateObj = $templateLoaderObj;
        $this->configObj = $configObj;
    }


    public function LoadBaseTemplate() {
        $this->AddBaseTemplateVariables();
        $navArray = array();
        foreach ($this->templateObj->views as $key => $value) {
            $navArray[$key] = $key;
        }
        $this->templateObj->AddLoopContent('navLoop', $navArray, 'foreach', 'a', false);
        $template = '';
        $template .= $this->templateObj->LoadTemplateFile('head');
        $template .= $this->templateObj->LoadTemplateFile('page-header');
        return $template;
    }

    public function LoadFooterTemplate() {
        return $this->templateObj->LoadTemplateFile('footer');
    }

    private function AddBaseTemplateVariables() {
        $this->templateObj->AddTemplateVariable('today', date('m/d/Y'));
        $this->templateObj->AddTemplateVariable('serverPath', $this->configObj->rootPath);
        $this->templateObj->AddTemplateVariable('templateName', $this->configObj->templateName);
    }

    public $templateObj;

    public $configObj;
}