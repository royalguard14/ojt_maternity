<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class RefDataHelper
{
    /**
     * Load reference file with optional caching.
     *
     * @param string $refName The name of the reference file.
     * @return array The reference data as an associative array.
     */
    public static function loadRefFile(string $refName): array
    {
        $cacheKey = "ref_data_{$refName}";

        // Check if cached data exists
        return Cache::remember($cacheKey, now()->addDay(), function () use ($refName) {
            $path = base_path("database/data/{$refName}.ref");

            if (!file_exists($path)) {
                return [];
            }

            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $data = [];

            foreach ($lines as $line) {
                // Skip header and comments
                if (str_starts_with($line, ';') || !str_contains($line, '|')) {
                    continue;
                }

                [$label, $code] = explode('|', $line, 2);
                $label = trim($label);
                $code = trim($code);

                // Use $code as the key and label as the value
                $data[$code] = $label;
            }

            return $data;
        });
    }
}
