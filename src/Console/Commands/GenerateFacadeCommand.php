<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Ammardaana\LaravelModular\Contracts\Traits\WithClassGenerator;
use Ammardaana\LaravelModular\Contracts\Traits\WithDomainOptions;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateFacadeCommand extends Command
{
    use WithClassGenerator, WithDomainOptions;

    protected ?string $domainName;

    protected ?string $className;

    protected string $namespacePostfix;

    protected string $stubName;

    protected string $type;

    protected string $suffixName;

    protected const STUB_NAME = 'facade.stub';

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:facade {--domain=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Facade Class';

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Facades';
        $this->type = 'Facade';
        $this->suffixName = 'Facade';
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->generateClass();
        $this->comment('Event created successfully.');

        return self::SUCCESS;
    }
}