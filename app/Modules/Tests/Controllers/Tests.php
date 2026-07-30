<?php

namespace App\Modules\Tests\Controllers;


use App\Controllers\BaseController;


class Tests extends BaseController
{
    public function index() 
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
        return $this->viewModule("index", [ "urls" => $urls ]);
    }


    public function form_login()
    {
        return $this->viewModule("form_login", [ "post_action" => base_url("tests/post_form_login") ]);
    }

    public function post_form_login() 
    {
        $data = $this->request->getPost();


        dd($data);

        // return $this->response->setJSON($data);
    }

}