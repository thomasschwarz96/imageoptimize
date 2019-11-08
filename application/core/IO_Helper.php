<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Helper class for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_Helper extends IO_Base
{
    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Create's an array with all needed optimize rule class names.
     *
     * @param   array   $formData       - Client form data
     * @return  array   Classname list
     */
    static public function getOptimizeRuleClasses($formData)
    {
        $classNames = array();
        $rulePrefix = 'IO_OptimizeRule';

        foreach ($formData as $field => $value)
        {
            $className = $rulePrefix . ucfirst($field);
            if (class_exists($className))
            {
                array_push($classNames, $className);
            }
        }

        return $classNames;
    }
}
