<?php

namespace Src\Controllers;
require '../Data/Conection.php';

use Src\Model\User;
use Laminas\Diactoros\Response\RedirectResponse;

class LoginController extends BaseController {


    public function getViewLogin()
    {
        $sessionUserId = $_SESSION['userId'] ?? null ;
        if ($sessionUserId) {
            return new RedirectResponse('/');
        }
        return $this->RenderHTML('Login.twig');
    }


    public function Intro($request)
    {
        $respondMessageError = null;
        $data = $request->getParsedBody();
        $user = User::where('username', $data['username'])->first();
        if ($user) {
            if (password_verify($data['password'],$user->password)) {
                $_SESSION['userId'] = $user->id;
                return new RedirectResponse('/');
            }else{
                $respondMessageError = "Incorrect";
            }
        }else{
            $respondMessageError = "Not found";
        }
        return $this->RenderHTML('Login.twig',[
            'respondMessageError' => $respondMessageError
        ]);
    }

















    public function Login($data)
    {
        $login = new User();
        $login->username = trim($data['username']);
        $login->password = md5(trim($data['password'],false));
        return $login->save();
    }
    // public function ListUsers()
    // {
    //     $register = new Register();
    //     return $register::all();
    // }

    // public function UserExiste($user)
    // {
    //     $register = new Register();
    //     $ListUser = $register::all();
    //     for ($i=0; $i < count($ListUser); $i++) { 
    //         if ($user == $ListUser[$i]{'name'}) {
    //         }
    //     }
    // }

}