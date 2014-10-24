<?php
class ClassLoader
{
    private $_prefixes = array();

    public function addPrefix($prefix, $baseDir)
    {
        $prefix = lcfirst(trim($prefix, '\\'));
        $baseDir = rtrim($baseDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $this->_prefixes[$prefix] = $baseDir;
    }

    public function loadClass($class)
    {
        $parts = array_map('lcfirst', explode('\\', ltrim($class, '\\')));
        $prefix = $parts[0];
        if (array_key_exists($prefix, $this->_prefixes)) {
            $rootPath = realpath($this->_prefixes[$prefix]);
            $filePath = $rootPath . DIRECTORY_SEPARATOR . implode('/', $parts) . '.php';
            if (file_exists($filePath)) {
                require $filePath;
            }
        }
        return true;
    }

    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
}