<?php

namespace Ammardaana\LaravelModular\Contracts\Interfaces;

interface Actionable
{

    public static function execute(?array $arguments = []);
}