<?php

require __DIR__ . "/../vendor/autoload.php";

$config = [
    'feature-one'   => true,
    'feature-two'   => false,
    'feature-three' => 'yes',
    'feature-four'  => 1
];

$featureFlagFilter = new \FeatureFlag\Filter\Simple( $config );

$featureFlag = new \FeatureFlag\FeatureFlag( $featureFlagFilter );

echo (int) $featureFlag->isEnabled( 'feature-one' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-two' ) . " should be false\n";
echo (int) $featureFlag->isEnabled( 'feature-three' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-four' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-five' ) . " should be false\n";
