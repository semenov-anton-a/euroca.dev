<?php

if (! function_exists('paginationPages')) {
    function paginationPages(int $currentPage, int $totalPages, int $visible = 5): array
    {
        if ($totalPages <= $visible + 2) {
            return range(1, $totalPages);
        }

        $half = intdiv($visible, 2);

        if ($currentPage <= $half + 1) {
            return array_merge(range(1, $visible), ['...'], [$totalPages]);
        }

        if ($currentPage >= $totalPages - $half) {
            return array_merge([1, '...'], range($totalPages - $visible + 1, $totalPages));
        }

        return array_merge(
            [1, '...'],
            range($currentPage - $half, $currentPage + $half),
            ['...'],
            [$totalPages]
        );
    }
}