# PHPTransformer

<a href="http://github.com/phptransformers/phptransformer"><img src="https://raw.githubusercontent.com/phptransformers/phptransformer/master/logo.png" align="right" height="140px"></a>
[![Latest Version](https://img.shields.io/github/release/phptransformers/phptransformer.svg?style=flat-square)](https://github.com/phptransformers/phptransformer/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/phptransformers/phptransformer/master.svg?style=flat-square)](https://travis-ci.org/phptransformers/phptransformer)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/phptransformers/phptransformer.svg?style=flat-square)](https://scrutinizer-ci.com/g/phptransformers/phptransformer/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/phptransformers/phptransformer.svg?style=flat-square)](https://scrutinizer-ci.com/g/phptransformers/phptransformer)
[![Total Downloads](https://img.shields.io/packagist/dt/phptransformers/phptransformers.svg?style=flat-square)](https://packagist.org/packages/phptransformers/phptransformer)

Common interface to manipulate strings/data with any transformer. Great for use in templating libraries, static site generators, web frameworks, and more. Inspired by [JSTransformers](http://github.com/jstransformers).

## Supported Transformers

To use each of these transformers, you will also need to `composer require` them in your project.

* [Twig](http://twig.sensiolabs.org)
* [Smarty](http://www.smarty.net)
* [Mustache](https://github.com/phptransformers/mustache)
* [StringTemplate](https://github.com/nicmart/StringTemplate)

## Install

Via Composer

``` bash
$ composer require phptransformers/phptransformer
```

## Usage

``` php
$transformer = new PhpTransformers\PhpTransformer\TwigTransformer();
echo $transformer->render('Hello, {{ name }}!', array(
	'name' => 'World'
));
//=> Hello, World!
```

## API

Before all examples, you will need to load a transformer:

``` php
$transformer = new PhpTransformers\PhpTransformer\TwigTransformer();
$transformer = new PhpTransformers\PhpTransformer\SmartyTransformer();
$transformer = new PhpTransformers\PhpTransformer\StringTemplateTransformer();
```

### `->render($template, $locals)`

Renders the given template string, using the provides locals for options passed
in. Returns the result as a string.

``` php
$locals = array('name' => 'World');
$output = $transformer->render('Hello, {{ name }}!', $locals);
```

### `->renderFile($file, $locals)`

Renders the given file, using the provided locals for options passed in.
Returns the result as a string.

``` php
$locals = array('name' => 'World');
$output = $transformer->renderFile('hello.twig', $locals);
```

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Rob Loach](https://github.com/RobLoach)
- [stoeffel](https://github.com/stoeffel)
- [MacFJA](https://github.com/MacFJA)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
