<?php

/*****************************************************************************************
 * @name...........: ViewDefaultControllerObj
 * @class..........: ViewDefaultControllerObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 05/12/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class ViewAdminControllerObj extends ViewDefaultBaseControllerObjAbs
{

    public function LoadTemplate()
    {
        try {
            $view = '';

            $view .= $this->LoadBaseTemplate();

            //This must be done here since admin pages will not have nav set in parent
            $this->SetNavigation();

            if (!$this->authenticationObj->isAuthenticated) {
                $view .= $this->templateObj->LoadTemplateFile('Views/' . $this->templateObj->GetViewRequest() . '/loginForm');
            } else {
                $view .= $this->templateObj->LoadTemplateFile('Views/' . $this->templateObj->GetViewRequest() . '/' . $this->currentPage);
            }
        } catch (Exception $e) {
            //lol yeah it's a nested try-catch but maybe we can gracefully throw an error without puking all over the page if something happens
            try {
                $this->templateObj->AddTemplateVariable('error', $e->getMessage());
                if (0 == stripos($e->getMessage(), 'Template file does not exist')) {
                    $view .= $this->templateObj->LoadTemplateFile('404');
                } else {
                    $view .= $this->templateObj->LoadTemplateFile('error');
                }
            } catch (Exception $e) {
                $view .= $e->getMessage();
            }
        }

        $view .= parent::LoadFooterTemplate();

        return $view;
    }

    public function LoadBaseTemplate()
    {
        parent::AddBaseTemplateVariables();
        $this->SetNavigation();
        $template = '';
        $template .= $this->templateObj->LoadTemplateFile('head');
        $template .= $this->templateObj->LoadTemplateFile('page-header');

        return $template;
    }

    private $navigationArray;

    private $currentPage;

    private $pages;

    private function SetAdminPages() {
        $excludeArray = array('..', '.');
        $adminPageArray = scandir($this->configObj->templatePath . '/Views/' . $this->configObj->adminDirectory);

        $pages = array();
        foreach ($adminPageArray as $eachPage) {
            if (!in_array($eachPage, $excludeArray)) {
                $pages[] = $eachPage;
            }
        }

        $this->pages = $pages;
    }

    private function SetCurrentAdminPage() {
        $currentPage = 'Home';
        if (isset($_GET['adminPage'])) {
            if(in_array($_GET['adminPage'], $this->navigationArray)) {
                $currentPage = $_GET['adminPage'];
            } else {
                throw new Exception('Template file does not exist');
            }
        }

        $this->currentPage = $currentPage;
    }

    private function SetAdminNavigationArray() {
        $navArray = array();
        foreach ($this->pages as $page) {
            $navArray[] = str_ireplace('.html', '', $page);
        }

        $this->navigationArray = $navArray;
    }

    private function SetNavigation() {
        $this->SetAdminPages();
        $this->SetCurrentAdminPage();
        $this->SetAdminNavigationArray();
        //Move Home to the beginning of the array
//        $navArray = $this->ManageAuthenticationViews($navArray);

        $navLoopLeft  = '';
        $navLoopRight = '';
        foreach ($this->navigationArray as $navLink) {
            if ('Login' == $navLink || 'Logout' == $navLink) {
                $navLoopRight .= "<li><a href='?adminPage={$navLink}'>{$navLink}</a></li>";
            } else {
                $navLoopLeft .= "<li><a href='?adminPage={$navLink}'>{$navLink}</a></li>";
            }
        }

        $this->templateObj->AddTemplateVariable('navLoopLeft', $navLoopLeft);
        $this->templateObj->AddTemplateVariable('navLoopRight', $navLoopRight);
    }
}