<?php

namespace FeatureFlag\Filter;

class Simple implements IFilter
{
    /**
     * @var array
     */
    protected $map;

    /**
     * @param $featureFlagMap
     *
     * @throws \Exception
     */
    public function __construct( $featureFlagMap )
    {
        $this->setMap( $featureFlagMap );
    }

    /**
     * @param array $featureFlagMap
     *
     * @throws \Exception
     */
    private function setMap( array $featureFlagMap )
    {
        if( !is_array( $featureFlagMap ) )
            throw new \Exception( 'Map must be of type [array]' );

        $this->map = $featureFlagMap;
    }

    /**
     * @param $feature
     *
     * @return bool
     */
    public function isEnabled( $feature )
    {
        if( isset( $this->map[ $feature ] ) )
        {
            if( is_bool( $this->map[ $feature ] ) )
                return $this->map[ $feature ];

            return (bool) $this->map[ $feature ];
        }

        return false;
    }

}