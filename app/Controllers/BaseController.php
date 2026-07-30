<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// Only FOR TEST
use App\Helpers\ClassHelper;

// Auth
use App\Services\Auth\UserService;
use App\Repositories\UserRepository;

// View 
use App\Services\View\MenuService;

// Traits
use App\Traits\ModuleViewTrait;
// Feature: Toast notifications
// use App\Services\View\ToastService;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    use ModuleViewTrait; 

    /**
     * Menu service instance.
     */
    protected MenuService $menuService;

    /**
     * Toast service instance.
     */
    // protected ToastService $toastService;

    /**
     * User service instance.
     */
    protected UserService $userService;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload shared services
        // $this->menuService = new MenuService();
        // $this->toastService = new ToastService();
        $this->userService = new UserService( new UserRepository() );
    }

    /**
     * Build menu based on user permissions.
     */
    protected function buildMenu(): array
    {
        return [ 'menu'=>  "Feature not implemented yet." ];
    
        // $permissions = session('permissions', []);
        // return $this->menuService->getMenu($permissions);
    }  

    /**
     * Check if user is logged in.
     */
    protected function isLoggedIn(): bool
    {
        return $this->userService->isLoggedIn();
    }

    /**
     * Get current user.
     */
    protected function currentUser(): ?array
    {
        return $this->userService->currentUser();
    }

    protected function _getControllerMethods(string $controller): array
    {
        return ClassHelper::_getControllerMethods($controller);
    }

}