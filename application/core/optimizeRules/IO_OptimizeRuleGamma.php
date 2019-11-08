<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Gamma optimize rule for IO_Optimizer.
 *
 * @package     ImageOptimize
 * @author      Thomas Schwarz
 * @copyright   Copyright (c) 2019, Thomas Schwarz. (https://www.image-optimize.com/)
 * @license     MIT License (https://opensource.org/licenses/MIT)
 * @link        https://www.image-optimize.com/
 * @since       Version 0.1.0
 * @filesource
 */
class IO_OptimizeRuleGamma extends IO_OptimizeRule
{
    /**
     * Correction for gamma.
     *
     * @var float
     */
    private $_correction;


    /**
     * @inheritDoc
     */
    protected function _setRuleOptions()
    {
        $options = $this->_options;
        if (isset($options['correction']))
        {
            $this->_correction = $options['correction'];
        }
    }


    /**
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->_correction = FALSE;
        $this->_optionName = 'gamma';
    }


    /**
     * @inheritDoc
     */
    public function execute()
    {
        if (!$this->_correction)
        {
            return $this->_image;
        }
        return $this->_image->gamma($this->_correction);
    }


    /**
     * Set specific validation rules.
     *
     * @param   {CI_Form_validation}    $validator      - Client side validator
     */
    public static function setValidationRules($validator)
    {
        $validator->set_rules('gamma[active]', 'Use gamma', 'in_list[on]|trim|strip_tags');
        $validator->set_rules('gamma[correction]', 'Gamma correction', 'numeric|trim|strip_tags');
    }
}
