<?php

namespace Ammardaana\LaravelModular\Contracts\Traits;

use Exception;
use Illuminate\Process\Pipe;
use Illuminate\Support\Facades\Process;

trait WithDomainOptions
{
    protected function resolveInput(string $directoryName)
    {
        $this->domainName = $this->option('domain');
        if (empty($this->domainName)) {
            $domainList = $this->getDomainsList($directoryName);
            if (!count($domainList)) {
                throw new Exception('You need to have domain first ...');
            }

            $this->domainName = $this->choice('Please select your domain', $this->mapSelectDomains(
                $this->getDomainsList($directoryName)
            ));
        }

        $this->className = $this->option('name');

        if (empty($this->className)) {
            $this->className = $this->ask("Please enter the name of the {$this->type}");
        }

        $this->stubName = self::STUB_NAME;
    }


    private function getDomainsList(string $directoryName): ?array
    {
        $pipe = Process::pipe(function (Pipe $process) use ($directoryName) {
            $process->command('ls ' . app_path("/$directoryName"));
        });

        return collect(explode(',', preg_replace('/\s+/', ',', $pipe->output())))
            ->filter()
            ->toArray();
    }

    private function mapSelectDomains(?array $domains): array
    {
        $formattedDomains = [];
        foreach ($domains as $domain) {
            $formattedDomains[$domain] = $domain;
        }

        return $formattedDomains;
    }
}