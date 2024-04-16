# tp-make-service
thinkphp框架命令行创建Service Class(即服务层，基于controller-service-repository目录架构)



## 如何使用

- 1.安装扩展

  ```bash
  # thinkphp5.*版本
  composer require jian1098/tp-make-service:1.0.1
  
  # thinkphp6.0+版本
  composer require jian1098/tp-make-service:2.0.1
  ```

  

- 2.注册命令

  - Thinkphp5

    在`application/command.php`文件中添加一行

    ```php
    return [
        'Jian1098\TpMakeService\Command\Service',
    ];
    ```

  - Thinkphp6+

    在`config/console.php`文件中添加一行

    ```php
    return [
        // 指令定义
        'commands' => [
            'make:service' => 'Jian1098\TpMakeService\Command\Service',
        ],
    ];
    ```

    **注意事项：**该命令会替换tp6框架自带的`make:service`命令，如果不想替换，可以将上面的`make:service`改为其他你喜欢的指令

  配置完后，在命令行执行`php think`命令，可以看到增加了`make:service`命令

  ```bash
   ...
   make
    make:command       Create a new command class
    make:controller    Create a new resource controller class
    make:middleware    Create a new middleware class
    make:model         Create a new model class
    make:service       Create a new service class    # 新增加的命令
    make:validate      Create a validate class
  ...
  ```

  

- 3.命令行创建文件

  ```bash
  php think make:service TestService
  ```

  执行上面的命令将创建文件`application/common/service/TestService.php`，内容如下

  ```php
  <?php
  
  namespace app\common\service;
  
  use app\common\repository\TestRepository;
  
  class TestService
  {
      /**
       * 绑定仓库
       * @var TestRepository
       */
      protected $repository;
  
      public function __construct(TestRepository $repository)
      {
          $this->repository = $repository;
      }
  
  
  }
  ```

  创建其他的service以此类推