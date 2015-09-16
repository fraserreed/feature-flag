<?php

namespace FeatureFlag\Filter;

class DistributedIp implements IFilter
{
    /**
     * @var float
     */
    protected $weight;

    /**
     * @param $weight
     */
    public function __construct( $weight )
    {
        //if value is a float, less than one, translate to percentage
        if( is_float( $weight ) && $weight < 1 )
            $weight *= 100;

        $this->weight = (int) $weight;
    }

    /**
     * Based on distribution of feature flag, determine if IP address is
     * enabled or not.
     *
     * Uses crc32 of ip address in order to produce predictable results.
     *
     * @param      $feature
     * @param null $ipAddress
     *
     * @return bool
     */
    public function isEnabled( $feature, $ipAddress = null )
    {
        if( is_null( $ipAddress ) )
            return false;

        return ( crc32( $ipAddress ) % 100 ) < $this->weight;
    }

}