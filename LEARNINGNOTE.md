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
Contracts与Facades没有特别的区别，开发第三方包时使用Contracts，因为不能访问facades测试函数


