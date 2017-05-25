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
    function __construct(TemplateLoaderObj $templateLoaderObj, ConfigObj $configObj, AuthenticationObj $authenticationObj)
    {
        $this->templateObj       = $templateLoaderObj;
        $this->configObj         = $configObj;
        $this->authenticationObj = $authenticationObj;
        $this->authenticationObj->CheckSession();
        $this->authenticationObj->CheckForLogOut();
    }

    public function LoadBaseTemplate()
    {
        $this->AddBaseTemplateVariables();

        $this->SetNavigation();

//        $this->templateObj->AddLoopContent('navLoop', $navArray, 'foreach', 'li><a', false);
        $template = '';
        $template .= $this->templateObj->LoadTemplateFile('head');
        $template .= $this->templateObj->LoadTemplateFile('page-header');

        return $template;
    }


    /**
     * @return string
     */
    public function LoadTemplate()
    {
        /** Stub see children */
        return '';
    }


    public function LoadFooterTemplate()
    {
        return $this->templateObj->LoadTemplateFile('footer');
    }

    public function SetPageAsAdmin() {
        $this->isAdminPage = true;
    }

    protected function AddBaseTemplateVariables()
    {
        $this->templateObj->AddTemplateVariable('today', date('m/d/Y'));
        $this->templateObj->AddTemplateVariable('serverPath', $this->configObj->rootPath);
        $this->templateObj->AddTemplateVariable('templateName', $this->configObj->templateName);
    }

    private function array_unshift_assoc(&$arr, $key, $val)
    {
        unset($arr[$key]);
        $arr       = array_reverse($arr, true);
        $arr[$key] = $val;

        return array_reverse($arr, true);
    }


    private function ManageAuthenticationViews($views)
    {
        if (true === $this->authenticationObj->isAuthenticated) {
            //Move Login to the end of the array
            $logout = $views['Logout'];
            unset($views['Logout']);
            $views['Logout'] = $logout;
            unset($views['Login']);

            return $views;
        }

        //Move Login to the end of the array
        $login = $views['Login'];
        unset($views['Login']);
        $views['Login'] = $login;
        unset($views['Logout']);

        return $views;
    }

    private function SetNavigation() {
        $navArray = array();
        foreach ($this->templateObj->views as $key => $value) {
            $navArray[$key] = $key;
        }

        //Get rid of default since it's just Homes ugly twin
        unset($navArray['Default']);
        //Get rid of Admin in normal page navigation, it must be visited directly
        unset($navArray[$this->configObj->adminDirectory]);

        //Move Home to the beginning of the array
        $navArray = $this->array_unshift_assoc($navArray, 'Home', $navArray['Home']);
        $navArray = $this->ManageAuthenticationViews($navArray);

        $navLoopLeft  = '';
        $navLoopRight = '';
        foreach ($navArray as $key => $value) {
            if ('Login' == $key || 'Logout' == $key) {
                $navLoopRight .= "<li><a href='{$key}'>{$key}</a></li>";
            } else {
                $navLoopLeft .= "<li><a href='{$key}'>{$key}</a></li>";
            }
        }

        $this->templateObj->AddTemplateVariable('navLoopLeft', $navLoopLeft);
        $this->templateObj->AddTemplateVariable('navLoopRight', $navLoopRight);
    }

    protected $templateObj;

    protected $configObj;

    protected $authenticationObj;

    protected $isAdminPage = false;
}