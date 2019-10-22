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
        'core/',
        'core/optimizeRules/'
    );

    foreach ($paths as $path)
    {
        if (is_readable(APPPATH . $path . $class . '.php'))
        {
            require_once(APPPATH . $path . $class . '.php');
        }
    }
}
