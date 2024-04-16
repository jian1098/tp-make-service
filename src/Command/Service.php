<?php

namespace Jian1098\TpMakeService\Command;

use think\App;
use think\console\command\Make;

class Service extends Make
{
    protected $type = "Service";

    protected function configure()
    {
        parent::configure();
        $this->setName('make:service')
            ->setDescription('Create a new service class');
    }

    protected function getStub()
    {
        $stubPath = __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR;

        return $stubPath . 'Service.stub';
    }

    protected function getNamespace(string $app): string
    {
        return parent::getNamespace($app) . '\\' . 'service';
    }

    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $class = str_replace($namespace . '\\', '', $name);
        $repositoryName = str_replace('Service', '', $class) . 'Repository';

        return str_replace(['{%className%}', '{%namespace%}', '{%repositoryName%}'], [
            $class,
            $namespace,
            $repositoryName,
        ], $stub);

    }
}
