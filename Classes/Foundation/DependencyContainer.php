<?php

/*****************************************************************************************
 * @name...........: DependencyContainer
 * @class..........: DependencyContainer
 * @description..... This serves as a very simple dependency injection container for the application
 *
 * @author.........: ATyler
 * @createDate.....: 04/25/2017
 *
 ******************************************************************************************/
class DependencyContainer
{
    /** @var  ConfigObj $ConfigObj */
    public $ConfigObj;

    /** @var  TemplateLoaderObj $TemplateLoaderObj */
    public $TemplateLoaderObj;

    /** @var  AjaxDoSomethingObj $AjaxDoSomethingObj */
    public $AjaxDoSomethingObj;

    /** @var  ViewControllerObj $ViewControllerObj */
    public $ViewControllerObj;

    function __construct()
    {
        $this->InitializeInjection();
    }

    private function InitializeInjection()
    {
        $this->ConfigObj          = new ConfigObj();
        $this->TemplateLoaderObj  = new TemplateLoaderObj($this->ConfigObj);
        $this->AjaxDoSomethingObj = new AjaxDoSomethingObj($this->ConfigObj);
        //Magic view controller loader
        $this->InitializeViewControllers();
        $this->ViewControllerObj  = new ViewControllerObj($this);
    }

    private function InitializeViewControllers()
    {
        $templateObj       = $this->TemplateLoaderObj;

        $templateObj->GetViewsList();
        foreach ($templateObj->views as $key => $value) {
            $className = "View{$key}ControllerObj";
            if (class_exists($className)) {
                $this->$className = new $className($templateObj, $this->ConfigObj);
            } else {
                $this->$className = new ViewDefaultControllerObj($templateObj, $this->ConfigObj);
            }
        }
    }
}