<?php
declare(strict_types=1);

namespace App\Services;

use CodeIgniter\HTTP\Files\UploadedFile;

class FileService
{
    private const MAX_FILE_SIZE = 10 * 1024 * 1024;

    private const ALLOWED_EXTENSIONS = [
        'pdf' => ['application/pdf'],
        'jpg' => ['image/jpeg'],
        'jpeg' => ['image/jpeg'],
        'png' => ['image/png'],
        'doc' => ['application/msword'],
        'docx' => [
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ],
    ];

    public function validate(array $files): array
    {
        $errors = [];

        foreach ($files as $index => $file) 
        {
            if (!$file instanceof UploadedFile) {
                $errors["documents.$index"] = 'Invalid uploaded file.';
                continue;
            }

            if (!$file->isValid()) {
                $errors["documents.$index"] = $file->getErrorString();
                continue;
            }

            if (!$file->getTempName() || !is_file($file->getTempName())) {
                $errors["documents.$index"] = 'Uploaded file is no longer available.';
                continue;
            }

            if ($file->getSize() > self::MAX_FILE_SIZE) {
                $errors["documents.$index"] = 'File size must not exceed 10 MB.';
                continue;
            }

            $extension = strtolower($file->getClientExtension());

            if (!isset(self::ALLOWED_EXTENSIONS[$extension])) {
                $errors["documents.$index"] = 'File type is not allowed.';
                continue;
            }

            $mimeType = $file->getMimeType();

            if (!in_array($mimeType, self::ALLOWED_EXTENSIONS[$extension], true)) {
                $errors["documents.$index"] = 'Invalid file content.';
            }
        }

        return $errors;
    }

    public function save(array $files, string $directory): array
    {
        $path = WRITEPATH . 'uploads/' . trim($directory, '/\\');

        if (!is_dir($path)
            && !mkdir($path, 0750, true)
            && !is_dir($path)
        ) {
            throw new \RuntimeException('Unable to create upload directory.');
        }

        $savedFiles = [];

        try {
            foreach ($files as $file) {
                if (!$file instanceof UploadedFile || !$file->isValid()) {
                    continue;
                }

                $extension = strtolower($file->getClientExtension());
                $mimeType = $file->getMimeType();
                $size = $file->getSize();
                $originalName = $file->getClientName();
                $filename = bin2hex(random_bytes(16)) . '.' . $extension;

                $file->move($path, $filename);

                $savedFiles[] = [
                    'filename' => $filename,
                    'original_name' => $originalName,
                    'extension' => $extension,
                    'mime_type' => $mimeType,
                    'size' => $size,
                ];
            }
        } catch (\Throwable $e) {
            $this->delete($savedFiles, $directory);
            throw $e;
        }

        return $savedFiles;
    }

    public function delete(array $files, string $directory): void
    {
        $path = WRITEPATH . 'uploads/' . trim($directory, '/\\');

        foreach ($files as $file) {
            if (empty($file['filename'])) {
                continue;
            }

            $filePath = $path . DIRECTORY_SEPARATOR . $file['filename'];

            if (is_file($filePath)) {
                unlink($filePath);
            }
        }

        if (is_dir($path) && count(scandir($path)) === 2) {
            rmdir($path);
        }
    }
}
