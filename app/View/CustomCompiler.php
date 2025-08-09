<?php

namespace App\View;

use Illuminate\Filesystem\Filesystem;
use InvalidArgumentException;

class CustomCompiler
{
    public function __construct(
        Filesystem $files,
        ?string $cachePath = null,
        string $basePath = '',
        bool $shouldCache = true,
        string $compiledExtension = 'php'
    ) {
        // Set default cache path if not provided
        if (empty($cachePath)) {
            $cachePath = storage_path('framework/views');
        }

        // Ensure cache path is absolute and exists
        $cachePath = realpath($cachePath) ?: $cachePath;
        
        if (!$cachePath || !is_string($cachePath)) {
            throw new InvalidArgumentException('Please provide a valid cache path.');
        }

        // Create directory if it doesn't exist
        if (!is_dir($cachePath)) {
            if (!mkdir($cachePath, 0755, true) && !is_dir($cachePath)) {
                throw new InvalidArgumentException("Cannot create cache directory: {$cachePath}");
            }
        }

        // Check if directory is writable
        if (!is_writable($cachePath)) {
            throw new InvalidArgumentException("Cache path is not writable: {$cachePath}");
        }

        $this->files = $files;
        $this->cachePath = $cachePath;
        $this->basePath = $basePath;
        $this->shouldCache = $shouldCache;
        $this->compiledExtension = $compiledExtension;
    }
}