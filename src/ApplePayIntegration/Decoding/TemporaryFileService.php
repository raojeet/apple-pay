<?php

namespace ApplePayIntegration\Decoding;

class TemporaryFileService
{
    private $fileHandle;

    public function __construct()
    {
        $this->fileHandle = tmpfile();
    }

    public function createFile(string $content): self
    {
        $file = new self();
        $file->write($content);
        return $file;
    }

    public function getPath(): string
    {
        $fileMetadata = stream_get_meta_data($this->fileHandle);
        return $fileMetadata['uri'];
    }

    private function write(string $content): void
    {
        fwrite($this->fileHandle, $content);
    }
}
