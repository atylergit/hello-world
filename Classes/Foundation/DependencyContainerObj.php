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
class DependencyContainerObj
{
    /** @var  ConfigObj $ConfigObj */
    public $ConfigObj;

    /** @var  AuthenticationObj $AuthenticationObj */
    public $AuthenticationObj;

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
        $this->ConfigObj               = new ConfigObj();
        $this->AuthenticationObj       = new AuthenticationObj($this->ConfigObj);
        $this->TemplateLoaderObj       = new TemplateLoaderObj($this->ConfigObj, $this->AuthenticationObj);
        $this->AjaxAuthenticateUserObj = new AjaxAuthenticateUserObj($this->ConfigObj, $this->AuthenticationObj);
        $this->AjaxDoSomethingObj      = new AjaxDoSomethingObj($this->ConfigObj, $this->AuthenticationObj);

        //Not to be mistaken with the above magic loader, this actually figures out the view and how to run it
        $this->ViewControllerObj = new ViewControllerObj($this->InitializeViewControllers(), $this->ConfigObj);
    }

    private function InitializeViewControllers()
    {
        $templateObj = $this->TemplateLoaderObj;
        $viewsArray  = array();
        $templateObj->GetViewsList();
        foreach ($templateObj->views as $key => $value) {
            $className = "View{$key}ControllerObj";
            if ($key == $this->ConfigObj->adminDirectory) {
                $className = "ViewAdminControllerObj";
            }
            // If there is a custom view controller we load it here otherwise we use the default
            if (class_exists($className)) {
                $viewsArray[$className] = new $className($templateObj, $this->ConfigObj, $this->AuthenticationObj);
            } else {
                $viewsArray[$className] = new ViewDefaultControllerObj($templateObj, $this->ConfigObj, $this->AuthenticationObj);
            }
        }

        return $viewsArray;
    }
}