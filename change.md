## v1.0.1

- 统一的 `Response` 返回结构

- 统一的异常处理

- `routes/api.php` 文件中的路由默认命名空间修改为 `App\Api\Http\Controllers` 

- 定义专门的 `Api http` 请求处理目录, 目录位置: `app\Api\Http`

    * 添加命令 `api:controller`, 创建 Api 专属控制器, 使用方法与默认的 `make:controller` 相同

    * 添加命令 `api:middleware`, 创建 Api 专属中间件, 使用方法与默认的 `make:middleware` 相同

    * 添加命令 `api:request`, 创建 Api 专属表单验证, 使用方法与默认的 `make:request` 相同

    * 添加命令 `api:resource`, 创建 Api 专属资源类型, 使用方法与默认的 `make:resource` 相同

- `api/*` 路由添加跨域支持

## v1.0.0

- [Laravel 5.7](https://laravel.com/docs/5.7)