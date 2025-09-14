<?php

namespace Ammardaana\LaravelModular\Contracts\Traits;

use Ammardaana\LaravelModular\Contracts\Interfaces\Actionable;
use Exception;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;

trait WithClassGenerator
{
    /**
     * Return the Singular Capitalize Name
     */
    public function getSingularClassName($name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Return the stub file path
     */
    public function getStubPath(): string
    {
        return __DIR__ . "/../Stubs/{$this->stubName}";
    }

    /**
     **
     * Map the stub variables present in stub to its value
     */
    public function getStubVariables(): array
    {
        $className = Str::contains($this->className, $this->type) ? Str::replace($this->type, '', $this->className) : $this->className;

        return [
            'NAMESPACE' => "App\\Domains\\{$this->domainName}\\{$this->namespacePostfix}",
            'CLASS_NAME' => $this->getSingularClassName($className),
        ];
    }

    /**
     * Get the stub path and the stub variables
     *
     * @return bool|mixed|string
     */
    public function getSourceFile()
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     *
     * @param array $stubVariables
     * @return bool|mixed|string
     */
    public function getStubContents($stub, $stubVariables = [])
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the full path of generate class
     */
    public function getSourceFilePath(): string
    {
        $className = Str::contains($this->className, $this->type) ? Str::replace($this->type, '', $this->className) : $this->className;
        $classNamePostfix = ($this->namespacePostfix === 'ServiceFacades') ? 'Service' : $this->getSingularClassName($this->namespacePostfix);

        return base_path("app/Domains/{$this->domainName}/{$this->namespacePostfix}")
            . '/'
            . $this->getSingularClassName($className)
            . $classNamePostfix
            . '.php';
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeDirectory(string $path): string
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    protected function generateClass(string $directoryName = 'Domains')
    {
        //Todo:: make connector instead of the domains
        $this->resolveInput($directoryName);

        $path = $this->getSourceFilePath();

        //$this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            try {
                $this->files->put($path, $contents);
                $this->info("File : {$path} created");
            } catch (Exception $exception) {
                $this->error("Domain {$this->domainName} not found! please make sure you create the domain first");
            }
        } else {
            $this->warn("File : {$path} already exits");
        }
    }

}