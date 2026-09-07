<?php

namespace App\Helpers;

class AssetHelper
{
    private static array $versions = [];
    public static function asset(string $file): string
    {
        if (!isset(self::$versions[$file])) 
        {   
            $path = FCPATH . 'assets/' . $file;

            self::$versions[$file] = is_file($path)
                ? filemtime($path)
                : null;
        }

        $url = base_url('assets/' . $file);

        if (self::$versions[$file] !== null) {
            $url .= '?v=' . self::$versions[$file];
        }

        return $url;
    }
}