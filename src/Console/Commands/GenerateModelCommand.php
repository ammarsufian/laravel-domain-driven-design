<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Ammardaana\LaravelModular\Contracts\Traits\WithClassGenerator;
use Ammardaana\LaravelModular\Contracts\Traits\WithDomainOptions;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class GenerateModelCommand extends Command
{
    use WithClassGenerator, WithDomainOptions;

    protected ?string $domainName;

    protected ?string $className;

    protected string $namespacePostfix;

    protected string $stubName;

    protected string $type;
    protected string $suffixName;

    protected const STUB_NAME = 'model.stub';

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model {--domain=} {--name=} {--with-resources=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Domain Model Class';

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Models';
        $this->type = 'Model';
        $this->suffixName = '';
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->generateClass();
        $this->comment('Model created successfully.');

        if (!empty($this->option('with-resources'))) {
            $this->warn('Generating resources (Action, Service) classes!');
            $this->generateResources($this->className);
        }
        return self::SUCCESS;
    }

    private function generateResources(string $name)
    {
        Artisan::call('make:migration', [
            'name' => "create_{$name}_table",
            '--create' => Str::plural(Str::lower($name)),
        ]);

        Artisan::call('make:resource', [
            '--domain' => $this->domainName,
            '--name' => $name,
        ]);

        Artisan::call('make:controller', [
            '--domain' => $this->domainName,
            '--name' => $name,
        ]);

        Artisan::call('make:factory', [
            'name' => $name,
        ]);
    }
}