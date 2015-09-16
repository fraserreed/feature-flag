FeatureFlag
===========

Simple feature flag checking for PHP >=5.5.

[![Build Status](https://travis-ci.org/fraserreed/feature-flag.svg?branch=master)](https://travis-ci.org/fraserreed/feature-flag)

## Installation

Install this package in your application using [composer](http://composer.org).

In the require section, add the following dependency:
```
"fraserreed/feature-flag": "~0.2"
```

## Usage

Any of these approaches can be extended and put in a view helper in most frameworks.

### Static Configuration

For static, array based feature flags, ideally used in multi-environment deploys.

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

### Distributed IP Address Weighting

For an expected distribution across the IPv4 spectrum, a weighted configuration can be used.

First create the filter with the expected distribution factor.

```
//feature flag will be enabled 75% of the time
$featureFlagFilter = new \FeatureFlag\Filter\DistributedIp( 75 );
```

Then assert that a feature is enabled or not:

```
$featureFlag = new \FeatureFlag\FeatureFlag( $featureFlagFilter );

echo (int) $featureFlag->isEnabled( 'feature-one', '192.168.0.161' ) . " should be false\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) . " should be true\n";
```

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
