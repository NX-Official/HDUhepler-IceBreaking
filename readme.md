# 杭电助手破冰认人脸系统-后端

## 一、简介

一位不会GO的蒟蒻使用PHP写的认人脸系统，目前还在完善

配置文件和用户数据都直接文件存储在 `\src` 目录 （SQL的书买了吃灰了一暑假，所以不怎么会用）

至于“要求：导出HTTP接口，返回格式统一”我真的看不明白，就没做了

其他的都按照markdown里的做了

**界面很简陋，毕竟我不想折腾CSS之类的（小声BB）**

目前共有4个用户

- 1 张三 21000001

- 2 李四 21000002

- 3 王五 21000003

- 4 赵六 21000004


张三上传了4张照片，李四1张，王五1张，赵六没照片

## 二、使用步骤

1. 通过 `login.php` 登录（当然没登陆访问其他页面都会跳过去)
2. 登录后自动跳转到主页面 `index.php` ，给照片猜人
3. 通过侧边栏选择 **Person** 可以转到 `person.php` ，可以在这里查看身份信息和已经上传的照片，设置是否显示照片，上传照片，新建账户，注销账户等

## 三、运行环境

> 本人使用 Debian 4.9.228 + Apache 2.0 + PHP 7.0 默认配置

如果您手头上没有现成的PHP运行环境， [我的一个服务器](www.nickxu.top) 已经在运行这个实例了

## 四、 `\src` 目录格式

```
src
│  next_id.txt //下一个用户将会使用的ID号
│
...
├─ n //第n个用户的目录
│  │  department.txt          //保存部门信息
│  │  name.txt                //名称
│  │  school_number.txt       //学号
│  │  show_pic.txt            //是否显示自己的照片
│  │
│  └─pic //照片目录
│          1.png            
│          2.png
│          3.png
│          4.png
│          next_num.txt       //下一张照片的编号
|
...
```
