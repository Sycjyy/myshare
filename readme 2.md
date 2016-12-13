## 文档说明
### 1. 登录方式 form表单提交
```
接收字段参数：
username 用户名
password 密码
```
### 2.登录页调到注册页
需要填写注册页面的路由地址，填写位置在js/login.js下
```
$("#go_register").click(function(){
	//这里替换你的路由地址
	window.location = "./register.html";
});
```
### 3.注册页面 
发送验证码 请求方式ajax post url需要根据你自己的接口来填写
可以在login.js下搜索“发送手机验证码”,找到对应方法
```
	//接收字段参数:
	phone:手机号
``` 

注册第一个页面---下一步 请求方式 ajax post url 需要自己填写
可以在login.js下搜索“点击下一步”,找到对应方法
```
	//接收字段参数:
	phone: 手机号
    verify: 验证码
    password: 密码
    reset_password: 重复密码
``` 

注册第二个页面---立即注册 请求方式 ajax post url 需要自己填写 
可以在login.js下搜索“立即注册”,找到对应方法
```
	//接收字段参数:
	email: 邮箱
    username:  用户名
    grade: 年级
    city: 城市
    school: 学校
    sex: 性别
```    