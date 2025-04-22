<?php

namespace LiteFS;

class LiteFS
{
    private string $base;

    public function __construct(string $baseDir)
    {
        $this->base = realpath($baseDir);
        if (!$this->base) {
            throw new \Exception("Base directory does not exist.");
        }
    }

    private function path(string $file): string
    {
        $full = realpath($this->base . DIRECTORY_SEPARATOR . $file) ?: $this->base . DIRECTORY_SEPARATOR . $file;
        if (!str_starts_with($full, $this->base)) {
            throw new \Exception("Access denied: $file");
        }
        return $full;
    }
    public function createFile(string $file, string $content = ''): void
    {
        file_put_contents($this->path($file), $content);
    }

    public function readFile(string $file): string
    {
        return file_get_contents($this->path($file));
    }

    public function appendFile(string $file, string $content): void
    {
        file_put_contents($this->path($file), $content, FILE_APPEND);
    }

    public function deleteFile(string $file): void
    {
        unlink($this->path($file));
    }

    public function renameFile(string $old, string $new): void
    {
        rename($this->path($old), $this->path($new));
    }

    public function createDir(string $dir): void
    {
        mkdir($this->path($dir), 0777, true);
    }

    public function listDir(string $dir = '', bool $recursive = false): array
    {
        $fullPath = $this->path($dir);
        $rii = $recursive ? new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($fullPath)) : new \FilesystemIterator($fullPath);
        $files = [];
        foreach ($rii as $file) {
            if ($file->isDot()) continue;
            $files[] = str_replace($this->base . DIRECTORY_SEPARATOR, '', $file->getPathname());
        }
        return $files;
    }

    public function deleteDir(string $dir, bool $recursive = false): void
    {
        $path = $this->path($dir);
        if (!$recursive) {
            rmdir($path);
            return;
        }
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            $file->isDir() ? rmdir($file) : unlink($file);
        }
        rmdir($path);
    }

    public function moveDir(string $src, string $dest): void
    {
        rename($this->path($src), $this->path($dest));
    }

    public function copyDir(string $src, string $dest): void
    {
        $srcPath = $this->path($src);
        $destPath = $this->path($dest);
        mkdir($destPath, 0777, true);

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($srcPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $targetPath = $destPath . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
            if ($item->isDir()) {
                mkdir($targetPath);
            } else {
                copy($item, $targetPath);
            }
        }
    }

    public function exists(string $path): bool
    {
        return file_exists($this->path($path));
    }

    public function getSize(string $path): int
    {
        return filesize($this->path($path));
    }

    public function getExtension(string $path): string
    {
        return pathinfo($this->path($path), PATHINFO_EXTENSION);
    }

    public function isWritable(string $path): bool
    {
        return is_writable($this->path($path));
    }

    public function isReadable(string $path): bool
    {
        return is_readable($this->path($path));
    }
    
    public function zipDir(string $source, string $destination): void
    {
        $zip = new \ZipArchive();
        $zipPath = $this->path($destination);
        if ($zip->open($zipPath, \ZipArchive::CREATE) !== TRUE) {
            throw new \Exception("Cannot open zip file: $zipPath");
        }

        $sourcePath = $this->path($source);
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($sourcePath) + 1);
            $zip->addFile($filePath, $relativePath);
        }

        $zip->close();
    }

    public function unzip(string $zipFile, string $destination): void
    {
        $zip = new \ZipArchive();
        if ($zip->open($this->path($zipFile)) === TRUE) {
            $zip->extractTo($this->path($destination));
            $zip->close();
        } else {
            throw new \Exception("Cannot open zip file");
        }
    }
}
