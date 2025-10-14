<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Ammardaana\LaravelModular\Contracts\Traits\WithClassGenerator;
use Ammardaana\LaravelModular\Contracts\Traits\WithDomainOptions;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateConsoleJobCommand extends Command
{
    use WithClassGenerator, WithDomainOptions;

    protected ?string $domainName;

    protected ?string $className;

    protected ?string $folderName;

    protected string $namespacePostfix;

    protected string $stubName;

    protected string $type;
    protected string $suffixName;

    protected const STUB_NAME = 'command.stub';

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:command {--domain=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Domain Command Class';

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Console/Commands';
        $this->type = 'Command';
        $this->suffixName = 'Command';
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->generateClass();
        $this->comment('DTO created successfully.');

        return self::SUCCESS;
    }
}