<?php

namespace PhpTransformers\PhpTransformer;

use StringTemplate\Engine;
use StringTemplate\SprintfEngine;

/**
 * Class StringTemplateTransformer.
 *
 * Transformer for the template engine StringTemplate
 * {@see StringTemplate\Engine}, {@see StringTemplate\SprintfEngine}, {@see StringTemplate\AbstractEngine}
 *
 * @author  MacFJA
 * @license MIT
 * @package PhpTransformers\PhpTransformer
 */
class StringTemplateTransformer extends Transformer
{
    protected $engine;

    /**
     * Build the StringTemplate engine.
     *
     * @param array $options An array of parameters used to set up the StringTemplate
     *                       configuration. Available configuration values include:
     *                       - engine
     *                       - left_delimiter
     *                       - right_delimiter
     */
    public function __construct(array $options = array())
    {
        $defaultOption = array(
            'engine' => 'standard',
            'left_delimiter' => '{',
            'right_delimiter' => '}'
        );
        $options += $defaultOption;
        // Create the Smarty template engine.
        $this->engine = $this->getEngine($options['engine'], $options['left_delimiter'], $options['right_delimiter']);
    }

    protected function getEngine($key, $left, $right)
    {
        $sprintf = array('sprintf', 'sprintfengine', strtolower(SprintfEngine::class));

        if (in_array(strtolower($key), $sprintf, true)) {
            return new SprintfEngine($left, $right);
        }

        return new Engine($left, $right);
    }

    public function getName()
    {
        return 'string-template';
    }

    public function renderFile($file, array $locals = array())
    {
        return $this->engine->render(file_get_contents($file), $locals);
    }

    public function render($template, array $locals = array())
    {
        return $this->engine->render($template, $locals);
    }
}
