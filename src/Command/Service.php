<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 刘志淳 <chun@engineer.com>
// +----------------------------------------------------------------------

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

    protected function getNamespace($appNamespace, $module)
    {
        return parent::getNamespace($appNamespace, $module) . '\service';
    }

    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        $class = str_replace($namespace . '\\', '', $name);
        $repositoryName = str_replace('Service', '', $class) . 'Repository';

        return str_replace(['{%className%}', '{%namespace%}', '{%app_namespace%}', '{%repositoryName%}'], [
            $class,
            $namespace,
            App::$namespace,
            $repositoryName,
        ], $stub);

    }
}
