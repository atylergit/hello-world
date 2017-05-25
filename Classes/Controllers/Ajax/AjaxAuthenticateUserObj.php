<?php

/*****************************************************************************************
 * @name...........: DoSomethingObj
 * @class..........: DoSomethingObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 04/28/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class AjaxAuthenticateUserObj extends AjaxControllerObj
{
    public function Run()
    {
        try {
            $this->ValidateCommand();
            $userName = $_POST['userName'];
            $password = $_POST['password'];

            $this->authenticationObj->ValidateCredentials($userName, $password);
        } catch (Exception $exception) {
            // Bubble bubble
            throw new Exception($exception->getMessage());
        }

        $returnArr = array(
            'status' => 'success',
            'message' => 'Username and password correct!',
            'data' => array(),
            'friendlyText' => 'Username and password correct!',
            'alert' => 'false',
        );

        return $returnArr;
    }

    public function ValidateCommand()
    {
        if (!isset($_POST['userName']) || $_POST['userName'] == '') {
            throw new Exception('Username must be provided and cannot be blank!');
        }

        if (!isset($_POST['password']) || $_POST['password'] == '') {
            throw new Exception('password must be provided and cannot be blank!');
        }
    }
}