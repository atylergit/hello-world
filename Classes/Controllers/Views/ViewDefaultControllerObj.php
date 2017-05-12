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
        $view .= parent::LoadBaseTemplate();

        $arrayStuff = array(
            'hello' => 'this is a list using a foreach loop',
            'foo'   => 'here\'s an item',
            'bar'   => 'And another one',
            'Aye'   => 'Just one more...'
        );

        try {
            $this->templateObj->AddLoopContent('mrLoopy', $arrayStuff, 'foreach', 'li');

            $view .= $this->templateObj->LoadTemplateFile('/Views/' . $this->templateObj->GetViewRequest() . '/content');
        } catch (Exception $e) {
            //lol yeah it's a nested try but maybe we can gracefully throw an error without puking all over the page
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