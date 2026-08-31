<?php

namespace App\Modules\AdminSettings\Services;

class LogService
{
    private const LEVELS = 
    [
        'DEBUG',
        'INFO',
        'NOTICE',
        'WARNING',
        'ERROR',
        'CRITICAL',
        'ALERT',
        'EMERGENCY',
    ];

    public function getFiles(): array
    {
        $path = WRITEPATH . 'logs';

        if (!is_dir($path)) {
            return [];
        }

        $files = glob($path . DIRECTORY_SEPARATOR . 'log-*.log');

        if ($files === false) {
            return [];
        }

        usort($files, fn($a, $b) => filemtime($b) <=> filemtime($a));

        return $files;
    }

    public function getFile(string $fileName): ?string
    {
        $fileName = basename($fileName);

        foreach ($this->getFiles() as $file) {
            if (basename($file) === $fileName) {
                return $file;
            }
        }

        return null;
    }

    public function getFileName(string $file): string
    {
        return basename($file);
    }

    public function entries(
        string $file,
        ?string $level = null,
        string $sort = 'desc',
        string $search = ''
    ): array {
        $content = $this->read($file);

        $pattern = '/(?:\*\*)?(DEBUG|INFO|NOTICE|WARNING|ERROR|CRITICAL|ALERT|EMERGENCY)(?:\*\*)?\s+-\s+(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s+-->\s+(.*?)(?=\n(?:\*\*)?(?:DEBUG|INFO|NOTICE|WARNING|ERROR|CRITICAL|ALERT|EMERGENCY)(?:\*\*)?\s+-|\z)/s';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $entries = [];

        foreach ($matches as $match) {
            $entries[] = [
                'level'   => strtoupper($match[1]),
                'date'    => $match[2],
                'message' => trim($match[3]),
            ];
        }

        if ($level !== null && $level !== '') {
            $level = strtoupper($level);

            if (in_array($level, self::LEVELS, true)) {
                $entries = array_filter(
                    $entries,
                    fn(array $entry) => $entry['level'] === $level
                );
            }
        }

        $search = trim($search);

        if ($search !== '') {
            $search = mb_strtolower($search);

            $entries = array_filter(
                $entries,
                function (array $entry) use ($search) {
                    return str_contains(mb_strtolower($entry['message']), $search)
                        || str_contains(mb_strtolower($entry['level']), $search)
                        || str_contains(mb_strtolower($entry['date']), $search);
                }
            );
        }

        usort($entries, function (array $a, array $b) use ($sort) {
            $result = strcmp($a['date'], $b['date']);

            return $sort === 'asc' ? $result : -$result;
        });

        return array_values($entries);
    }

    public function getLevels(): array
    {
        return self::LEVELS;
    }

    private function read(string $file): string
    {
        if (!is_file($file) || !is_readable($file)) {
            throw new \RuntimeException('Failed to read log file.');
        }

        $content = file_get_contents($file);

        if ($content === false) {
            throw new \RuntimeException('Failed to read log file.');
        }

        return $content;
    }
}