<?php

namespace App\Modules\AdminSettings\Controllers;

use App\Controllers\BaseController;
use App\Modules\AdminSettings\Services\LogService;
use CodeIgniter\HTTP\ResponsableInterface;
use CodeIgniter\HTTP\ResponseInterface;
class Logs extends BaseController
{
    protected LogService $logService;

    public function __construct()
    {
        $this->logService = new LogService();
    }

    public function index(): string
    {
        $files = $this->logService->getFiles();

        $file = $files[0] ?? null;

        $entries = $file
            ? $this->logService->entries($file)
            : [];

        return $this->viewModule('Logs/index', [
            'files'   => $files,
            'file'    => $file,
            'entries' => $entries,
            'levels'  => $this->logService->getLevels(),
        ]);
    }

    public function read(string $fileName): string
    {
        $file = $this->logService->getFile($fileName);

        if ($file === null) {
            return view('Modules\AdminSettings\Views\Logs\_list', [
                'entries' => [],
            ]);
        }

        $level = $this->request->getGet('level');
        $sort = $this->request->getGet('sort') ?? 'desc';
        $search = $this->request->getGet('search') ?? '';

        $entries = $this->logService->entries(
            $file,
            $level,
            $sort,
            $search
        );

        return view('Modules\AdminSettings\Views\Logs\_list', [
            'entries' => $entries,
        ]);
    }

    public function removeAll() : ResponseInterface | string
    {
        $deleted = $this->logService->removeAll();

        $html = '
            <div id="log-files" hx-swap-oob="innerHTML">
                <div class="p-3 text-muted text-center">
                    No log files found.
                </div>
            </div>

            <div id="log-content" hx-swap-oob="innerHTML">
                <div class="text-muted text-center py-5">
                    <i class="bi bi-file-text fs-1 d-block mb-3"></i>
                    No log entries found.
                </div>
            </div>
        ';

        return 
            $this->htmxToastMessage('success', "Deleted {$deleted} log files.", "Logs")
            ->response
            ->setBody( $html );        
    }
}