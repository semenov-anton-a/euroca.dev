<?php

namespace App\Modules\Tests\Controllers;

use App\Controllers\BaseController;

class Tests extends BaseController
{

    private function _getUrls()
    {
        $methods = $this->_getControllerMethods(__CLASS__);

        $urls = [];

        foreach ($methods as $method) 
        {
            if (str_starts_with($method, 'post_')) {
                $urls['post'][$method] = base_url("tests/$method");
            } else {
                $urls['get'][$method] = base_url("tests/$method");
            }
        }
        return $urls;
    }

    public function index() 
    {
        return $this->viewModule("index", [ "urls" => $this->_getUrls() ]);
    }


    public function form_login()
    {
        return $this->viewModule("form_login", [ "post_action" => base_url("tests/post_form_login") ]);
    }

    public function post_form_login() 
    {
        $data = $this->request->getPost();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');
            
        $user = $this->userService->authenticate( $email, $password );
        
        return $this->viewModule("index", [ 
            "urls" => $this->_getUrls(),
            "dataVars" => $user,
        ]);        
    }


    public function feature(){ return $this->viewModule('feature'); }


}