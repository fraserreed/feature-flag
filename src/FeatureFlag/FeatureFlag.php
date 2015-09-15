<?php

namespace FeatureFlag;

use FeatureFlag\Filter\IFilter;


class FeatureFlag
{
    /**
     * @var IFilter
     */
    protected $filter;

    /**
     * @param IFilter $filter
     */
    public function __construct( IFilter $filter )
    {
        $this->filter = $filter;
    }

    /**
     * @param $feature
     *
     * @return bool
     */
    public function isEnabled( $feature )
    {
        return $this->filter->isEnabled( $feature );
    }
}