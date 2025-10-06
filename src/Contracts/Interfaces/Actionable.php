<?php

namespace Ammardaana\LaravelModular\Contracts\Interfaces;

interface Actionable
{

    public function execute(?array $arguments = []);
}