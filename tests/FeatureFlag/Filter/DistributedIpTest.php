<?php

namespace FeatureFlag\Tests\Filter;


use FeatureFlag\FeatureFlag;
use FeatureFlag\Filter\DistributedIp;


class DistributedIpTest extends \PHPUnit_Framework_TestCase
{
    public function testIsEnabledDistributedIpFilterAlwaysOff()
    {
        $featureFlag = new FeatureFlag( new DistributedIp( 0 ) );

        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );
    }

    public function testIsEnabledDistributedIpFilterAlwaysOn()
    {
        $featureFlag = new FeatureFlag( new DistributedIp( 100 ) );

        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );
    }

    public function testIsEnabledDistributedIpFilterSplit()
    {
        $featureFlag = new FeatureFlag( new DistributedIp( 50 ) );

        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );

        $featureFlag = new FeatureFlag( new DistributedIp( 52 ) );

        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) ); //51, now passes
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );
    }

    public function testIsEnabledDistributedIpFilterFloat()
    {
        $featureFlag = new FeatureFlag( new DistributedIp( 0.5 ) );

        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );

        $featureFlag = new FeatureFlag( new DistributedIp( 0.52 ) );

        $this->assertFalse( $featureFlag->isEnabled( 'feature-one', '192.168.1.100' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '31.12.127.255' ) ); //51, now passes
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '46.248.224.183' ) );
        $this->assertTrue( $featureFlag->isEnabled( 'feature-one', '58.136.218.102' ) );
    }

}