FeatureFlag
===========

Simple feature flag checking for PHP >=5.5.

[![Build Status](https://travis-ci.org/fraserreed/feature-flag.svg?branch=master)](https://travis-ci.org/fraserreed/feature-flag)

#### Installation

Install this package in your application using [composer](http://composer.org).

In the require section, add the following dependency:
```
"fraserreed/feature-flag": "~0.1"
```

#### Usage

Currently this library only support static, array based feature flags, ideally used in multi-environment deploys.

First create the static filter:

```
$config = [
    'feature-one'   => true,
    'feature-two'   => false,
    'feature-three' => 'yes',
    'feature-four'  => 1
];

$featureFlagFilter = new \FeatureFlag\Filter\Simple( $config );
```

Then assert that a feature is enabled or not:

```
$featureFlag = new \FeatureFlag\FeatureFlag( $featureFlagFilter );

echo (int) $featureFlag->isEnabled( 'feature-one' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-two' ) . " should be false\n";
echo (int) $featureFlag->isEnabled( 'feature-three' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-four' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-five' ) . " should be false\n";
```

This can be extended an put in a view helper in most frameworks.

## Tests

To run the tests you'll need to have phpunit installed.

Running the tests:

```
$ phpunit
```

## Contributing

For any issues, submit an issue via this repo.  For contributing please fork and submit PRs.

## License

MIT, see LICENSE.