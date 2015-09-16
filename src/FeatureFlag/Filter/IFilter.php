<?php

namespace FeatureFlag\Filter;

interface IFilter
{
    /**
     * @param      $feature
     * @param null $user
     *
     * @return bool
     */
    public function isEnabled( $feature, $user = null );
}