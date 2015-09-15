<?php

namespace FeatureFlag\Filter;

interface IFilter
{
    /**
     * @param $feature
     *
     * @return bool
     */
    public function isEnabled( $feature );
}