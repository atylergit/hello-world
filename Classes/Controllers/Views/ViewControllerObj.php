<?php

/*****************************************************************************************
 * @name...........: ViewControllerObj
 * @class..........: ViewControllerObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 05/12/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class ViewControllerObj
{
    function __construct(DependencyContainer $container)
    {
        $this->containerObj = $container;
    }

    public function Run() {
        $view = $this->GetViewRequest();
        if ($view == 'Home') {
            $view = 'Default';
        }

        $viewController = "View{$view}ControllerObj";
        if (!class_exists($viewController)) {
            $viewController = "ViewDefaultControllerObj";
        }

        $viewControllerObj = new $viewController($this->containerObj->TemplateLoaderObj, $this->containerObj->ConfigObj);
        return $viewControllerObj->LoadTemplate();
    }


    public function GetViewRequest() {
        if (!isset($_GET['page'])) {
            $_GET['page'] = 'Default';
        }

        $view = $_GET['page'];

        return $view;
    }

    private $containerObj;
}