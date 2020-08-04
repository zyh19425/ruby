####Learning note

##生命周期

public/index.php（入口）
	载入自动加载设置（composer）
	生成容器，获取APP实例
		创建Application实例
		绑定单例Http处理内核
		绑定单例Console处理内核
		绑定单例异常处理器
	处理请求，发送响应
		将请求发送给路由器
			注册请求到容器
			执行bootstrap
				注册系统环境配置.env
				注册系统配置
				注册异常处理器
				注册门面模式
				注册服务提供者
				注册服务提供者boot
			创建Pipeline
			将中间件发送到Pipeline
			将请求发送到Pipeline
			执行Pipeline处理
				执行前置中间件处理
				业务逻辑处理
				执行后置中间件处理
		分发请求处理结束事件
		返回response
	结束请求，进行回调

##Facades Contracts

Facades为服务容器提供「静态」接口，是服务容器中底层类的「静态代理」，使用灵活、易于测试
Contracts与Facades没有特别的区别，开发第三方包时使用Contracts，因为不能访问Facades测试函数

##基础

#路由

可用方法				get/post/put/patch/delete/options/match/any
csrf防护				post/put/delete
重定向				redirect/permanentRedirect
常用
	路由命名			name
	路由组			group
	中间件			middleware [验证/限流]
	命名空间			namespace
	子域名路由		domain
	路由前缀			prefix
	回退路由			fallback

#中间件

App/Http/Kernel.php
前置/后置中间件		$next($request)位置
全局中间件			$middleware
中间件群组			$middlewareGroups
中间件排序
中间件参数
Terminable中间件		同时接受请求和响应

#CSRF保护

App/Http/Middleware/VerifyCsrfToken

#控制器

定义控制器
命名空间
单行为控制器			invoke
资源型控制器			--resource
指定资源模型			--model
部分资源路由			except
API资源路由			apiResource
路由定义方式
	GET/PUT/POST/PUT/PATCH/DELETE
自定义资源URIs		resourceVerbs
依赖注入
	构造函数注入
	方法注入
路由缓存
	route:cache/clear

#请求

Illuminate\Http\Request
请求路径				path/is()
请求URL				url/fullUrl
请求方法				method/isMethod
$request
	输入				all/input/query/boolean/only/except/has/hasAny/filled/missing
	Session			flash/flashOnly/flashExcept
	旧数据			old
	Cookie			cookie
	文件				file/hasFile/[isValid/path/extension/store/storeAs]

#响应

字符串/数组
Response对象
	响应头			header/whthHeaders
	Cookie 			cookie
重定向				redirect/[back/route/action/away/with]
视图					view
JSON				json
文件下载				download
流下载				streamDownload
文件响应				file
响应宏（自定义）		macro

#视图

Blade文档
显示视图				return view()
创建第一个视图		return View::first() || view()->first()
传递参数				return view('', ['data'=>$data])/->with($data)
所有视图共享参数		View::share($data)
视图合成器			View::composer() 基于合成器的类/闭包，注册视图合成器

#生成URL

生成基础URL			url()
访问当前URL			url()->current()/->full()/->previous() || URL::current()
签名URL				URL::signedRoute() || temporarySignedRoute()
验证签名路由			$request->hasValidSignature() || 使用中间件
控制器行为URL		action()
默认值				URL::default()

#Session

配置					config/session.php
获取数据				$request->session()->get('key')
存储数据				$request->session()->put(['key'=>'value'])
全局辅助函数			session('key'[,'default'])
					session(['key'=>'value'])
获取所有				$request->session()->all()
验证是否存在			$request->session()->has('key')
					$request->session()->exists('key')
session数组			$request->session()->push('key','value')
					$request->session()->pull('key','default')
闪存数据				$request->session()->flash('key','value')
					$request->session()->reflash()/->keep(['key'])
删除数据				$request->session()->forget('key')/->flush()
重新生成SessionID	$request->session()->regenerate()

#表单验证

验证器				$request->validate()
命名错误包			$request->validateWithBag()
验证失败停止			[bail]
可选字段注意事项		[nullable]
创建表单验证器		php artisan make:request xx
	通过验证			$request->validated()
	添加钩子			function withValidator
	授权验证			function authorize
	自定义错误信息	function messages
	自定义验证属性	function attributes
	准备验证输入		function prepareForValidation
手动创建验证器		Validator::make($input,$rules,$messages)
	命名错误包		->withErrors($validator, '')
	验证后钩子		$validator->after()
	错误信息			$validatir->errors()
自定义验证规则		php artisan make:rule xx
	使用 			$request->validate(['name' => [new xx]])

#错误

配置 				.env  APP_DEBUG
					App/Exceptions/Handler
report/render自定义	$exception instanceof xx
全局变量				function context
report辅助函数		快速报告异常
不被记录异常			$dontReport
HTTP异常				abort(404)
自定义错误模板		php artisan vendor:publish --tag=laravel-errors

#日志

配置					config/logging.php
配置通道名称			channel-name
写日志消息			Log::emergency()/alert()/critical()/error()/warning()/notice()/info()/debug()
上下文				Log::info('message',['id'=>$user->id])
指定通道				Log::channel('stack')->info('message')

