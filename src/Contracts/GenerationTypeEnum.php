<?php

namespace Ammardaana\LaravelModular\Contracts;

enum GenerationTypeEnum: string
{
    case DOMAINS = 'domains';

    case INTEGRATIONS = 'integrations';
}