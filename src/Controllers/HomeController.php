<?php

namespace Src\Controllers;
use Laminas\Diactoros\Response\RedirectResponse;
use Src\Model\File;
use Src\Model\User;

require '../Data/Conection.php';

class HomeController extends BaseController{
    
    public function getViewHome()
    {
        $file = File::all()->filter(function ($files)
        {
            $idSessionUser = $_SESSION['userId'] ?? null;
            return $files->user_FK == $idSessionUser;
        });
        $Name = User::all()->filter(function ($Names)
        {
            $idSessionUser = $_SESSION['userId'] ?? null;
            return $Names->id == $idSessionUser;
        });
        return $this->RenderHTML('Home.twig',[
            'imgs' => $file,
            'users' => $Name
        ]);
    }

    public function postAddImg($request)
    {
        if ($request->getMethod() == 'POST') {
            // $data = $request->getParsedBody();
            $file = $request->getUploadedFiles();
            $img = $file['file'];
            if ($img->getError() == UPLOAD_ERR_OK) {
                $fileName = $img->getClientFilename();
                $img->moveTo("../view/Uploaded/$fileName");
                $filedb = new File();
                $filedb->file = "Uploaded/$fileName";
                $filedb->user_FK = $_SESSION['userId'];
                $filedb->save();
                return new RedirectResponse('/');
            }

            
        }
        return new RedirectResponse('/');
        // return $this->RenderHTML('Home.twig');
    }

    public function getLogout()
    {
        unset($_SESSION['userId']);
        return new RedirectResponse('/login');
    }
}