<?php

namespace Src\Controllers;

require '../Data/Conection.php';
require '../Model/User.php';

use Respect\Validation\Validator;
use Src\Model\File;
use Src\Model\User;

class RegistrerController extends BaseController
{
    public function getViewRegister()
    {
        
        return $this->RenderHTML('Register.twig');
    }
    public function AddUsers($request)
    {
        $respondMessage = null;
        if ($request->getMethod() == 'POST') {
            $data = $request->getParsedBody();
            $RegisterValidator = Validator::key('name', Validator::stringType()->notEmpty())
            ->key('email', Validator::stringType()->notEmpty())
            ->key('password', Validator::stringType()->notEmpty());
            if ($RegisterValidator->validate($data)) {
                $save = User::Register($data);
                if ($save) {
                    $respondMessage = 'Register Successful';
                }else {
                    $respondMessage = 'Register not Successful';
                }
            }
        }
        return $this->RenderHTML('Register.twig',[
            'respondMessage' => $respondMessage
        ]);
    }


}
