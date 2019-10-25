<?php
/*
|--------------------------------------------------------------------------
| Register function to load all IO core classes
|--------------------------------------------------------------------------
|
| This function is called by the "pre_system" hook.
|
*/
function load_io_classes()
{
    spl_autoload_register('io_classes');
}

/*
|--------------------------------------------------------------------------
| Load IO core classes
|--------------------------------------------------------------------------
|
| This function is called by the "spl_autoload_register()".
| Load all custom IO classes.
|
*/
function io_classes($class)
{
    if (strpos($class, 'CI_') === 0)
    {
        return;
    }

    $paths = array(
        IO_CORE_PATH,
        IO_OPTIMIZE_RULES_PATH
    );

    foreach ($paths as $path)
    {
        $classPath = $path . $class . '.php';
        if (is_readable($classPath))
        {
            require_once($classPath);
        }
    }
}
