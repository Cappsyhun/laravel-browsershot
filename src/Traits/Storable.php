<?php

namespace VerumConsilium\Browsershot\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use VerumConsilium\Browsershot\Wrapper;

trait Storable
{
    /**
     * Stores the generated output file to local storage
     *
     * @param string      $path
     * @param null|string $filename
     * @return string
     * @internal param null|string $visibility
     */
    public function store(string $path, string $visibility = 'private', ?string $filename = null): string
    {
        $this->generateTempFile();

        $file = new File($this->tempFile);

        if (!is_null($filename)) {
            return Storage::putFileAs($path, $file, $filename, $visibility);
        }

        return Storage::put($path, $file, $visibility);
    }

    /**
     * Stores the file output with public visibility
     *
     * @param string $path
     * @param string $filename
     * @return string
     */
    public function storeAs(string $path, string $filename, string $visibility = 'private'): string
    {
        return $this->store($path, $visibility, $filename);
    }

    abstract protected function getFileExtension(): string;

    abstract protected function generateTempFile(): Wrapper;
}
