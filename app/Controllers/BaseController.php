<?php

namespace App\Controllers;

// use Config\Services;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// Only FOR TEST
use App\Helpers\ClassHelper;



/** Auth Service */
use App\Modules\Auth\Config\Services as AuthServices;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Auth\Services\RoleService;
use App\Modules\Auth\Services\PermissionService;

/** Users Service */
use App\Modules\Users\Entities\User;
use App\Modules\Users\Config\Services as UserServices;
use App\Modules\Users\Services\UserService;


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

    protected AuthService $authService;
    protected UserService $userService;
    protected RoleService $roleService;
    protected PermissionService $permissionService;

    private function __tests()
    {
        $locator = \Config\Services::locator();

         dd([
            'servicesClass' => \Config\Services::serviceExists('authService'),
            'moduleServicesClass' => class_exists(\App\Modules\Auth\Config\Services::class),
            'moduleServices' => $locator->search('Modules/Auth/Config/Services'),
            'moduleConfig' => $locator->search('Modules/Auth/Config'),
            'search' => $locator->search('Config/Services'),
            'authServiceFile' => APPPATH . 'Modules/Auth/Config/Services.php',
            'file_exists' => is_file(APPPATH . 'Modules/Auth/Config/Services.php'),
            'class' => class_exists(\App\Modules\Auth\Config\Services::class),
            // (new \Config\Autoload())->psr4,
            // $locator->search('Config/Services'),
            // 'auth' => \Config\Services::serviceExists('authService'),
            // 'role' => \Config\Services::serviceExists('roleService'),
            // 'permission' => \Config\Services::serviceExists('permissionService'),
            
            // 'class' => class_exists(\App\Modules\Auth\Config\Services::class),
            // 'service' => \Config\Services::serviceExists('authService'),
            // 'discover' => (new \Config\Modules())->shouldDiscover('services'),
            // 'services' => \Config\Services::serviceExists('authService'),
        ]);
    }
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
        //////////////////////////////////////////////////////
        
        /**
         *  All TESTS HERE
         */
            $this->__tests();
        /**
         *  All TESTS HERE
         */


        // Load Services
        $this->authService = AuthServices::authService();
        $this->userService = UserServices::userService();
        $this->roleService = AuthServices::roleService();
        $this->permissionService = AuthServices::permissionService();
        
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
        return $this->authService->isLoggedIn();
    }


    /**
     * Get current user.
     */
    protected function currentUser(): ?User
    {
        return $this->authService->currentUser();
    }

    protected function _getControllerMethods(string $controller): array
    {
        return ClassHelper::_getControllerMethods($controller);
    }

    /**
     * Add an HTMX trigger to the response.
     *
     * @param string $name Trigger name.
     * @param mixed  $data Trigger data.
     *
     * @return static
     */
    protected function addHtmxTrigger( string $name, mixed $data = null ): static 
    {
        $triggers = [];

        $existing = $this->response->getHeaderLine('HX-Trigger');

        if ($existing !== '') {
            $decoded = json_decode($existing, true);

            if (is_array($decoded)) 
            {
                $triggers = $decoded;
            }
        }

        $triggers[$name] = $data;

        $this->response->setHeader(
            'HX-Trigger',
            json_encode(
                $triggers
                // JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            )
        );

        return $this;
    }

    /**
     * Set HTMX redirect.
     *
     * @param string $url Redirect URL.
     *
     * @return static
     */
    protected function setHtmxRedirect(string $url): static
    {
        $this->response->setHeader('HX-Redirect', $url);

        return $this;
    }


    protected function htmxToastMessage( string $type, string $message, string $title = ''  ): static
    {
        if ($title === '') { $title = $type; }

        $title = (string) "Toast." . $title;

        $data = [
            'type' => $type,
            'title'   => lang( $title ),
            'message' => $message
        ];

        return $this->addHtmxTrigger('toast', $data );        
    }

}