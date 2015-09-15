<?php

namespace FeatureFlag\Tests;


use FeatureFlag\FeatureFlag;
use FeatureFlag\Filter\Simple;


class FeatureFlagTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEnabledSimpleFilterEmpty()
    {
        $featureFlag = new FeatureFlag( new Simple( [ ] ) );

        $this->assertFalse( $featureFlag->isEnabled( 'test' ) );
    }

    public function testIsEnabledSimpleFilterNotEmpty()
    {
        $featureFlag = new FeatureFlag( new Simple( [ 'enabled' => true, 'not-enabled' => false, 'set-with-string' => 'yes' ] ) );

        $this->assertTrue( $featureFlag->isEnabled( 'enabled' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'not-enabled' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'set-with-string' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'not-set' ) );
    }

    public function testIsEnabledSimpleFilterMultiDimArray()
    {
        $featureFlag = new FeatureFlag( new Simple( [ 'one' => [ 'enabled' => true, 'not-enabled' => false ] ] ) );

        $this->assertFalse( $featureFlag->isEnabled( 'enabled' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'not-enabled' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'not-set' ) );
    }

}