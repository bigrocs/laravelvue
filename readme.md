<p align="center">
    <a href="https://github.com/laravel/laravel">
        <img src="https://laravel.com/assets/img/components/logo-laravel.svg">
    </a>
    <a href="https://github.com/vuejs/vue">
        <img width="64" src="https://vuejs.org/images/logo.png">
    </a>
    <a href="https://saucelabs.com/u/vuejs">
        <img src="https://saucelabs.com/browser-matrix/vuejs.svg">
    </a>
</p>


## 关于laravelVUE
Github：https://github.com/bigrocs/laravelvue

LaravelVUE前后端分离前端使用VUE 后端使用PHP框架laravel的CMS系统。

后端通过JSON数据自动定义前端页面显示内容。


## 系统要求

- PHP >= 5.6.4
- OpenSSL PHP 扩展
- PDO PHP 扩展
- OpenSSL 扩展
- Mbstring PHP 扩展
- Tokenizer PHP 扩展
- XML PHP 扩展
- GD 扩展
- MySQL >= 5.7

## 安装
下面我们以开发版本为例，讲述 LaravelVUE 的安装。

首先我们需要下载LaravelVUE项目解压到本地文件夹：

1、然后执行composer命令安装laravel依赖
```
composer install
```
2、重命名.env.example为.env 执行下面命令
```
php artisan key:generate
```
3、设置数据库配置修改.env文件下列代码
```
DB_DATABASE=homestead（数据库名称）
DB_USERNAME=homestead（数据库账号）
DB_PASSWORD=secret   （数据库密码）
```
4、接下来我们做数据库迁移和填充数据
```
php artisan migrate
php artisan db:seed
```
5、安装前端VUE编译以来
```
npm install
```
6、编译前端资源
```
npm run
```
7、编译前端资源开启BrowserSync（开发模式）
```
npm run watch
```
