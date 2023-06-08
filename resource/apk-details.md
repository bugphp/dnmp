# alpine 镜像内 apk 命令详解

## 1. apk add 
### 安装PACKAGES并自动解决依赖关系
```shell
# 安装软件包
$ apk add [包名]

# --no-cache 不使用缓存（推荐) 不使用缓存能减少容器中的尺寸
$ apk add --no-cache [包名]

# --update-cache 更新缓存
$ apk add --update-cache --repository https://mirrors.aliyun.com/alpine/edge/main --allow-untrusted

# -U 选项表示在安装软件包之前更新软件包索引
$ apk add -U [包名]

# --allow-untrusted 允许安装未经数字签名或无法通过包管理器验证签名的软件包,例如从第三方存储库或来源安装软件包
$ apk add --allow-untrusted [包名]

# 安装指定版本软件包
$ apk add asterisk=1.6.0.21-r0
$ apk add 'asterisk<1.6.1'
$ apk add 'asterisk>1.6.1'
```

## 2. apk del
### 卸载并删除PACKAGES
```shell
# 卸载包
$ apk del [包名]
```

## 3. apk update
### 从远程镜像源中更新本地镜像源索引
```shell
# 更新最新本地镜像源
$ apk update
```

## 4. apk search
### 搜索软件包
```shell
# 查找所有可用软件包
$ apk search [包名]

# 通过软件包名称查找软件包 以 acf 开头的包名
$ apk search -v 'acf*'

# 通过描述文件查找特定的软件包 包含 docker 的包名
$ apk search -v -d 'docker'
```

## 5. apk upgrade
### 升级已经安装过的包
```shell
# 升级全部软件
$ apk upgrade

# 指定升级软件包
$ apk add --upgrade [包名]

# 指定升级软件包 同上
$ apk add -u [包名] 
```

## 6. apk info
### 列出PACKAGES或镜像源的详细信息
```shell
# 列出所有已安装的软件包
$ apk info

# 显示完整的软件包信息
$ apk info -a [包名]

# 显示指定文件属于的包
$ apk info --who-owns [文件路径] # 例如 /sbin/apk
```

## 7. 其他
```shell
# 清理缓存
$ apk cache clean

## -v 显示详情
$ apk -v cache clean
```