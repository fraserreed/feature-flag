<?php

require __DIR__ . "/../vendor/autoload.php";

$config = [
    'feature-one'   => true,
    'feature-two'   => false,
    'feature-three' => 'yes',
    'feature-four'  => 1
];

$featureFlagFilter = new \FeatureFlag\Filter\DistributedIp( 75 );

$featureFlag = new \FeatureFlag\FeatureFlag( $featureFlagFilter );

echo (int) $featureFlag->isEnabled( 'feature-one', '192.168.0.161' ) . " should be false\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) . " should be true\n";
echo (int) $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) . " should be true\n";