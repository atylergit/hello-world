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
class ViewDefaultControllerObj extends ViewDefaultBaseControllerObjAbs
{

    public function LoadTemplate()
    {
        $view = '';
        try {
            $view .= parent::LoadBaseTemplate();
            $this->AddCustomTemplateVariables();

            $view .= $this->templateObj->LoadTemplateFile('Views/' . $this->templateObj->GetViewRequest() . '/content');
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

    private function AddCustomTemplateVariables() {
        $arrayStuff = array(
            'hello' => 'this is a list using a foreach loop',
            'foo'   => 'here\'s an item',
            'bar'   => 'And another one',
            'Aye'   => 'Just one more...'
        );

        $this->templateObj->AddLoopContent('mrLoopy', $arrayStuff, 'foreach', 'li');
    }
}