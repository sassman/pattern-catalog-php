<?php

namespace PatternCatalog\Structural\Decorator;

class FileOutputStream implements OutputStream
{
    /**
     * @var resource
     */
    private $handle;

    /**
     * @param string|resource $fileUrlOrHandle
     */
    public function __construct($fileUrlOrHandle)
    {
        if (is_string($fileUrlOrHandle)) {
            $fileUrlOrHandle = \fopen($fileUrlOrHandle, 'w');
        }
        if (!is_resource($fileUrlOrHandle)) {
            throw new \UnexpectedValueException('argument should be string or resource');
        }
        $this->handle = $fileUrlOrHandle;
    }

    /**
     * make sure resource is closed
     */
    public function __destruct()
    {
        \fclose($this->handle);
    }

    /**
     * @param string $string
     * @param array ...$parameter
     * @return void
     */
    public function println($string, ...$parameter)
    {
        $this->printf($string . PHP_EOL, ...$parameter);
    }

    /**
     * @param string $string
     * @param array ...$parameter
     * @return void
     */
    public function printf($string, ...$parameter)
    {
        \fwrite($this->handle, vsprintf($string, $parameter));
    }
}