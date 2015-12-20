<?php

namespace PhpTransformers\PhpTransformer;

use Twig_Loader_String;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigTransformer extends Transformer
{
    protected $twig;
    protected $loaders = array();
    protected $twigProvided = false;

    public function __construct(array $options = array())
    {
        $this->loaders['string'] = new \Twig_Loader_String();
        if (isset($options['twig'])) {
            $this->twigProvided = true;
            $this->twig = $options['twig'];
        } else {
            $this->twig = new Twig_Environment($this->loaders['string'], $options);
        }
    }

    public function getName()
    {
        return 'twig';
    }

    public function render($template, array $locals = array())
    {
        // Render the file using the straight string.
        $this->twig->setLoader($this->loaders['string']);

        return trim($this->twig->render($template, $locals));
    }

    public function renderFile($file, array $locals = array())
    {
        if ($this->twigProvided) {
            // If Twig_Environment was provided, we must suppose its loaders are initialized too.
            return trim($this->twig->render($file, $locals));
        }

        // Construct a new loader from the base path.
        $path = dirname(realpath($file));
        if (!isset($this->loaders[$path])) {
            $this->loaders[$path] = new Twig_Loader_Filesystem($path);
        }
        $this->twig->setLoader($this->loaders[$path]);

        // Render the file using its file name.
        return trim($this->twig->render(basename($file), $locals));
    }
}
