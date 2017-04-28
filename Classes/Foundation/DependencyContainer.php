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

    /** @var  AjaxDoSomethingObj $DoSomethingObj */
    public $DoSomethingObj;

    function __construct()
    {
        $this->InitialiseInjection();
    }

    private function InitialiseInjection()
    {
        $this->ConfigObj         = new ConfigObj();
        $this->TemplateLoaderObj = new TemplateLoaderObj($this->ConfigObj);
        $this->DoSomethingObj    = new AjaxDoSomethingObj($this->ConfigObj);
    }
}