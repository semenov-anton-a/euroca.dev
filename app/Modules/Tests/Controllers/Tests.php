<?php

namespace App\Modules\Tests\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Services\View\MenuService;

class Tests extends BaseController
{
    public function index() 
    {      
        return $this->viewModule("index", [ "urls" => $this->_getUrls() ]);
    }

    public function phpIni()
    {
        return $this->response->setBody( '<pre>' . esc(print_r( phpinfo(), true)) . '</pre>' );
    }


    public function form_login()
    {
        return $this->viewModule("form_login", [ "post_action" => base_url("tests/post_form_login") ]);
    }

    public function post_form_login() 
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');
            
        $user = $this->userService->authenticate( $email, $password );
        
        return $this->viewModule("index", [ 
            "urls" => $this->_getUrls(),
            "dataVars" => $user,
        ]);        
    }

    public function logout() : ResponseInterface
    {
        $this->userService->logout();
        return redirect()->to('/');
    }

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


    public function feature(){ return $this->viewModule('feature'); }

    public function authServices(): string
{
    $userId = 1;

    // $roleService = Services::roleService();
    // $permissionService = Services::permissionService();

    echo '<pre>';

    echo "=== USER ===\n";

    $user = $this->userService->currentUser();

    print_r($user);

    echo "\n=== ROLE ===\n";

    print_r(
        $this->roleService->getUserRole($userId)
    );

    echo "\n=== ROLE NAME ===\n";

    var_dump(
        $this->roleService->getUserRoleName($userId)
    );

    echo "\n=== SUPER ADMIN ===\n";

    var_dump(
        $this->roleService->isSuperAdmin($userId)
    );

    echo "\n=== CARGO VIEW ===\n";

    var_dump(
        $this->permissionService->can(
            $userId,
            'cargo.view'
        )
    );

    echo "\n=== CARGO DELETE ===\n";

    var_dump(
        $this->permissionService->can(
            $userId,
            'cargo.delete'
        )
    );

    echo "\n=== UNKNOWN PERMISSION ===\n";

    var_dump(
        $this->permissionService->can(
            $userId,
            'something.unknown'
        )
    );

    echo "\n=== ALL PERMISSION ===\n";

    var_dump(
        $this->permissionService->getUserPermissions($userId)
    );


    echo '</pre>';

    return '';
}

    public function AdminLTE() : ResponseInterface
    {
        return redirect()->to('/adminlte');
    }


}