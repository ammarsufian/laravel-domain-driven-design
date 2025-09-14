<?php

namespace Ammardaana\LaravelModular\Console\Commands;


use Ammardaana\LaravelModular\Contracts\Traits\WithClassGenerator;
use Ammardaana\LaravelModular\Contracts\Traits\WithDomainOptions;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class GenerateControllerCommand extends Command
{
    use WithClassGenerator, WithDomainOptions;

    protected ?string $domainName;

    protected ?string $className;

    protected string $namespacePostfix;

    protected string $stubName;

    protected string $type;

    protected const STUB_NAME = 'controller.stub';

    protected $files;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:controller {--domain=} {--name=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Domain controller Class';

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->namespacePostfix = '/Http/Controllers';
        $this->type = 'Controller';
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $this->generateClass();
            $this->comment('Controller created successfully.');

            return self::SUCCESS;

        } catch (Exception $exception) {
            $this->error($exception->getMessage());
            return self::FAILURE;
        }

    }
}