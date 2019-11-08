<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Invert optimize rule for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleInvert extends IO_OptimizeRule
{
    /**
     * @inheritDoc
     */
    protected function _setRuleOptions()
    {
        // nothing to do here
    }


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_optionName = 'invert';
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->_image->invert();
    }


    /**
     * Set specific validation rules.
     *
     * @param   {CI_Form_validation}    $validator      - Client side validator
     */
    public static function setValidationRules($validator)
    {
        $validator->set_rules('invert', 'Invert', 'greater_than[0]|trim|strip_tags');
    }
}
