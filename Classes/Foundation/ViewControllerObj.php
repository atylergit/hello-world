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
    function __construct($viewsArray, ConfigObj $configObj)
    {
        $this->viewsObj = $viewsArray;
        $this->configObj = $configObj;
    }

    public function Run()
    {
        $view = $this->GetViewRequest();
        if ($view == 'Home') {
            $view = 'Default';
        }

        $viewController    = "View{$view}ControllerObj";

        //We want peeps to be able to change the URL of the Admin so here we are overwriting the dynamic class loader so nobody has to worry about renaming the class and the file
        if($view == $this->configObj->adminDirectory) {
            $viewController = "ViewAdminControllerObj";
        }

        if (class_exists($viewController)) {
            /** @var ViewDefaultBaseControllerObjAbs $viewControllerObj */
            $viewControllerObj = $this->viewsObj[$viewController];
        } else {
            /** @var ViewDefaultBaseControllerObjAbs $viewControllerObj */
            $viewControllerObj = $this->viewsObj['ViewDefaultControllerObj'];
        }

        return $viewControllerObj->LoadTemplate();
    }


    public function GetViewRequest()
    {
        if (!isset($_GET['page'])) {
            $_GET['page'] = 'Home';
        }

        $view = $_GET['page'];

        return $view;
    }

    private $viewsObj;

    private $configObj;
}