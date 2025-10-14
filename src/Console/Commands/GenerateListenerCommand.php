<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Ammardaana\LaravelModular\Contracts\Traits\WithClassGenerator;
use Ammardaana\LaravelModular\Contracts\Traits\WithDomainOptions;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateListenerCommand extends Command
{
    use WithClassGenerator, WithDomainOptions;

    protected ?string $domainName;

    protected ?string $className;

    protected ?string $folderName;


    protected string $namespacePostfix;

    protected string $stubName;

    protected string $type;

    protected string $suffixName;

    protected const STUB_NAME = 'listener.stub';

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:listener {--domain=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Listener Class';

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = 'Listeners';
        $this->type = 'Listener';
        $this->suffixName = 'Listener';
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->generateClass();
        $this->comment('Listener created successfully.');

        return self::SUCCESS;
    }
}