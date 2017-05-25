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
class ViewLoginControllerObj extends ViewDefaultBaseControllerObjAbs
{

    public function LoadTemplate()
    {

        try {
            $view = '';
            $view .= parent::LoadBaseTemplate();

            if (!$this->authenticationObj->isAuthenticated) {
                $view .= $this->templateObj->LoadTemplateFile('Views/' . $this->templateObj->GetViewRequest() . '/loginForm');
            } else {
                $view .= $this->templateObj->LoadTemplateFile('Views/' . $this->templateObj->GetViewRequest() . '/loginConfirmation');
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
}