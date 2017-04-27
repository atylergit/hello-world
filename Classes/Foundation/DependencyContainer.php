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

    /** @var  WarpObject $WarpObjectObj */
    public $WarpObjectObj;

    /** @var  TemplateLoaderObj $TemplateLoaderObj */
    public $TemplateLoaderObj;

    function __construct()
    {
        $this->InitialiseInjection();
    }

    private function InitialiseInjection()
    {
        $this->ConfigObj         = new ConfigObj();
        $this->WarpObjectObj     = new WarpObject();
        $this->TemplateLoaderObj = new TemplateLoaderObj($this->ConfigObj);
    }
}