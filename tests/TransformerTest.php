<?php

namespace PhpTransformers\PhpTransformer\Test;

class TransformerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider engineProvider
     */
    public function testRenderFile($name, $className)
    {
        $class = 'PhpTransformers\\PhpTransformer\\' . $className;
        $engine = new $class();
        $template = "tests/Fixtures/$className.$name";
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->renderFile($template, $locals);
        $this->assertEquals('Hello, Linus!', $actual);
    }

    /**
     * @dataProvider engineProvider
     */
    public function testRender($name, $className)
    {
        $class = 'PhpTransformers\\PhpTransformer\\' . $className;
        $engine = new $class();
        $template = file_get_contents("tests/Fixtures/$className.$name");
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->render($template, $locals);
        $this->assertEquals('Hello, Linus!', $actual);
    }

    /**
     * @dataProvider engineProvider
     */
    public function testGetName($name, $className)
    {
        $class = 'PhpTransformers\\PhpTransformer\\' . $className;
        $engine = new $class();
        $this->assertEquals($name, $engine->getName());
    }

    /**
     * @dataProvider engineOptionsProvider
     */
    public function testOptions($className, $fixtureName, $options)
    {
        $class = 'PhpTransformers\\PhpTransformer\\' . $className;
        $engine = new $class($options);
        $template = file_get_contents("tests/Fixtures/$fixtureName");
        $locals = array(
            'name' => 'Linus',
        );
        $actual = $engine->render($template, $locals);
        $this->assertEquals('Hello, Linus!', $actual);
    }

    public function engineProvider()
    {
        $tests[] = array('smarty', 'SmartyTransformer');
        $tests[] = array('twig', 'TwigTransformer');
        $tests[] = array('string-template', 'StringTemplateTransformer');

        return $tests;
    }

    public function engineOptionsProvider()
    {
        return array(
            array('StringTemplateTransformer', 'StringTemplate/delimiter.txt', array('left_delimiter' => ':', 'right_delimiter' => '')),
            array('StringTemplateTransformer', 'StringTemplate/sprintf.txt', array('engine' => 'sprintf')),
        );
    }
}
