<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateDomainCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:domain {--name= : Domain name!} {--with-samples=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Introduce a new Domain to you Laravel Application';

    /**
     * Execute the console command.
     *
     *
     * @throws Exception
     */
    public function handle(): int
    {
        $domainName = $this->option('name');
        if (empty($domainName)) {
            $domainName = $this->ask('Please enter the name of the Domain?');
        }
        $domainName = Str::studly($domainName);

        $this->warn("creating '{$domainName}' Domain now!");

        try {
            $this->createDomain($domainName);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        if (!empty($this->option('with-samples'))) {
            $this->warn('Generating Sample (Action, Service) classes!');
            $this->generateSamples($domainName);
        }

        $this->comment('Domain Created Successfully!');

        return self::SUCCESS;
    }

    /**
     * @throws Exception
     */
    private function createDomain(string $domainName)
    {
        $appPath = $this->laravel['path'];
        if (!File::exists($appPath . '/Domains')) {
            File::makeDirectory($appPath . '/Domains');
        }
        $domainPath = $appPath . '/Domains/' . $domainName;

        if (File::exists($domainPath)) {
            throw new Exception("Domain '{$domainName}' already exists!");
        }

        File::ensureDirectoryExists($domainPath);
        //cd app/Domain/{$domainName}
        File::chmod($domainPath);

        //create required folders
        File::ensureDirectoryExists("$domainPath/Http");
        File::ensureDirectoryExists("$domainPath/Actions");
        File::ensureDirectoryExists("$domainPath/DTOs");
        File::ensureDirectoryExists("$domainPath/Events");
        File::ensureDirectoryExists("$domainPath/Listeners");
        File::ensureDirectoryExists("$domainPath/Services");
        File::ensureDirectoryExists("$domainPath/Models");

        //create Http folders
        File::ensureDirectoryExists("$domainPath/Http/Requests");
        File::ensureDirectoryExists("$domainPath/Http/Controllers");
        File::ensureDirectoryExists("$domainPath/Http/Middleware");
        File::ensureDirectoryExists("$domainPath/Http/Resources");

        //cd back
        File::chmod($domainPath);
    }

    private function generateSamples(string $domainName)
    {
        Artisan::call('make:action', ['--domain' => $domainName, '--name' => 'SampleAction']);
        Artisan::call('make:dto', ['--domain' => $domainName, '--name' => 'SampleDTO']);
        Artisan::call('make:service', ['--domain' => $domainName, '--name' => 'SampleService']);
    }
}