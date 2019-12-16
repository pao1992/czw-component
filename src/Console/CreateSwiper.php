<?php

namespace Czw\Component\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class CreateSwiper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:swiper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $directory = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->initAdminDirectory();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //运行迁移文件
        $this->initDatabase();
        $this->createController();
        //生成控制器文件
        //增加路由内容
//        $this->info(__DIR__);
//        $file = file_get_contents(__DIR__ . '/test.stub');
//        file_put_contents(__DIR__.'/test.php',$file);

    }

    public function initDatabase()
    {
        //复制文件到migrations目录下
        $migrationFile = __DIR__.'/../../database/migrations/swiper/2019_12_11_075421_create_component_swiper_table.php';
        copy($migrationFile,database_path('migrations').'/2019_12_11_075421_create_component_swiper_table.php');
        $this->call('migrate');
//        $this->laravel['files']
//        $userModel = config('admin.database.users_model');
//
//        //生成测试数据
//        if ($userModel::count() == 0) {
//            $this->call('db:seed', ['--class' => \Encore\Admin\Auth\Database\AdminTablesSeeder::class]);
//        }
    }
    //创建控制器
    public function createController()
    {
        $Controller = $this->directory . '/Http/Controllers/SwiperController.php';
        $contents = $this->getStub('SwiperController');

        $this->laravel['files']->put(
            $Controller,
            str_replace('DummyNamespace', config('admin.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $Controller));
    }
    //初始化项目路径
    protected function initAdminDirectory()
    {
        $this->directory = config('component.directory');
    }
    //获取控制器模板
    protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/$name.stub");
    }
}
