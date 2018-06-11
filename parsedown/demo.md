---
description: 'CentOS 7.4 安装 oh-my-zsh'
---

# CentOS 7.4 安装 oh-my-zsh
刚买了一个阿里云, 一口气买了 3 年. 因为正好赶上互动了. 哈哈. 既然买了, 就要折腾啊. 所以, 开始搞起. 

ssh 连接我的阿里云, 什么都是默认的, 是 CentOS 7.4, 其他的什么都没装. 

![](https://user-images.githubusercontent.com/17526777/41191167-d1d57150-6c1d-11e8-8973-7b8047d90f0a.png)

看着这个基础的 bash, 我是忍不了的. 当然得用大名鼎鼎的 oh-my-zsh 啦. 

先看一下我的 mac 上使用 oh-my-zsh 的样子. 

![](https://user-images.githubusercontent.com/17526777/41191194-7d4e1604-6c1e-11e8-8d8f-64f0ac74b781.png)

比默认的 bash 好看了不是一点半点啊. 

闲话不多说, 搞起. 

## oh-my-zsh 官网

http://ohmyz.sh

## 安装

```php
<?php

require dirname(__FILE__)."/../vendor/autoload.php";

$Parsedown = new Parsedown();

echo($Parsedown->text('Hello _Parsedown_!'));
// you can also parse inline markdown only
echo($Parsedown->line('Hello _Parsedown_!'));

$md = file_get_contents(__DIR__ . '/demo.md');

echo($Parsedown->parse($md));


```

`sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"`

```bash
[root@iZm5eat7o13nmw3p7hg674Z ~]# sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
Zsh is not installed! Please install zsh first!
[root@iZm5eat7o13nmw3p7hg674Z ~]#
```

呀哈, 看来我得先去安装 zsh 啦. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z ~]# yum install -y zsh
Loaded plugins: fastestmirror
base                                                                                                                                                                                | 3.6 kB  00:00:00
epel                                                                                                                                                                                | 3.2 kB  00:00:00
extras                                                                                                                                                                              | 3.4 kB  00:00:00
updates                                                                                                                                                                             | 3.4 kB  00:00:00
(1/7): epel/x86_64/group_gz                                                                                                                                                         |  88 kB  00:00:00
(2/7): base/7/x86_64/group_gz                                                                                                                                                       | 166 kB  00:00:00
(3/7): extras/7/x86_64/primary_db                                                                                                                                                   | 147 kB  00:00:00
(4/7): epel/x86_64/updateinfo                                                                                                                                                       | 931 kB  00:00:00
(5/7): updates/7/x86_64/primary_db                                                                                                                                                  | 2.0 MB  00:00:00
(6/7): epel/x86_64/primary                                                                                                                                                          | 3.5 MB  00:00:00
(7/7): base/7/x86_64/primary_db                                                                                                                                                     | 5.9 MB  00:00:01
Determining fastest mirrors
epel                                                                                                                                                                                           12588/12588
Resolving Dependencies
--> Running transaction check
---> Package zsh.x86_64 0:5.0.2-28.el7 will be installed
--> Finished Dependency Resolution

Dependencies Resolved

===========================================================================================================================================================================================================
 Package                                      Arch                                            Version                                                  Repository                                     Size
===========================================================================================================================================================================================================
Installing:
 zsh                                          x86_64                                          5.0.2-28.el7                                             base                                          2.4 M

Transaction Summary
===========================================================================================================================================================================================================
Install  1 Package

Total download size: 2.4 M
Installed size: 5.6 M
Downloading packages:
zsh-5.0.2-28.el7.x86_64.rpm                                                                                                                                                         | 2.4 MB  00:00:01
Running transaction check
Running transaction test
Transaction test succeeded
Running transaction
  Installing : zsh-5.0.2-28.el7.x86_64                                                                                                                                                                 1/1
  Verifying  : zsh-5.0.2-28.el7.x86_64                                                                                                                                                                 1/1

Installed:
  zsh.x86_64 0:5.0.2-28.el7

Complete!
[root@iZm5eat7o13nmw3p7hg674Z ~]#
```


安装后, 要查看一下存在的 shell. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z ~]# cat /etc/shells
/bin/sh
/bin/bash
/sbin/nologin
/usr/bin/sh
/usr/bin/bash
/usr/sbin/nologin
/bin/zsh
[root@iZm5eat7o13nmw3p7hg674Z ~]#
```

ok, 可以看到刚装上的 zsh. 


我记得更改 shell 的命令是 `chsh`, 先看一下 help 再说. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z ~]# chsh --help

Usage:
 chsh [options] [username]

Options:
 -s, --shell <shell>  specify login shell
 -l, --list-shells    print list of shells and exit

 -u, --help     display this help and exit
 -v, --version  output version information and exit

For more details see chsh(1).
[root@iZm5eat7o13nmw3p7hg674Z ~]#
```

看来我没记错. 那就执行吧. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z ~]# chsh -s /bin/zsh
Changing shell for root.
Shell changed.
[root@iZm5eat7o13nmw3p7hg674Z ~]#
```

记的要关闭终端重新登录一下哦. 

我重启了我的终端. 再查看一下我现在的 shell.

```shell
[root@iZm5eat7o13nmw3p7hg674Z]~# echo $SHELL
/bin/zsh
[root@iZm5eat7o13nmw3p7hg674Z]~#
```

可以看到, 已经是 zsh 了. 

这回再安装 oh-my-zsh 吧. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z]~# sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
Cloning Oh My Zsh...
Error: git is not installed
[root@iZm5eat7o13nmw3p7hg674Z]~#
```

好吧. 缺什么我就装什么. 再安装 git. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z]~# yum info git
Loaded plugins: fastestmirror
Loading mirror speeds from cached hostfile
Available Packages
Name        : git
Arch        : x86_64
Version     : 1.8.3.1
Release     : 13.el7
Size        : 4.4 M
Repo        : base/7/x86_64
Summary     : Fast Version Control System
URL         : http://git-scm.com/
License     : GPLv2
Description : Git is a fast, scalable, distributed revision control system with an
            : unusually rich command set that provides both high-level operations
            : and full access to internals.
            :
            : The git rpm installs the core tools with minimal dependencies.  To
            : install all git packages, including tools for integrating with other
            : SCMs, install the git-all meta-package.

[root@iZm5eat7o13nmw3p7hg674Z]~#
```

版本老了点, 能用就行. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z]~# yum install -y git
Loaded plugins: fastestmirror
Loading mirror speeds from cached hostfile
Resolving Dependencies
--> Running transaction check
---> Package git.x86_64 0:1.8.3.1-13.el7 will be installed
--> Processing Dependency: perl-Git = 1.8.3.1-13.el7 for package: git-1.8.3.1-13.el7.x86_64
--> Processing Dependency: rsync for package: git-1.8.3.1-13.el7.x86_64
--> Processing Dependency: perl(Term::ReadKey) for package: git-1.8.3.1-13.el7.x86_64
--> Processing Dependency: perl(Git) for package: git-1.8.3.1-13.el7.x86_64
--> Processing Dependency: perl(Error) for package: git-1.8.3.1-13.el7.x86_64
--> Processing Dependency: libgnome-keyring.so.0()(64bit) for package: git-1.8.3.1-13.el7.x86_64
--> Running transaction check
---> Package libgnome-keyring.x86_64 0:3.12.0-1.el7 will be installed
---> Package perl-Error.noarch 1:0.17020-2.el7 will be installed
---> Package perl-Git.noarch 0:1.8.3.1-13.el7 will be installed
---> Package perl-TermReadKey.x86_64 0:2.30-20.el7 will be installed
---> Package rsync.x86_64 0:3.1.2-4.el7 will be installed
--> Finished Dependency Resolution

Dependencies Resolved

===========================================================================================================================================================================================================
 Package                                               Arch                                        Version                                                 Repository                                 Size
===========================================================================================================================================================================================================
Installing:
 git                                                   x86_64                                      1.8.3.1-13.el7                                          base                                      4.4 M
Installing for dependencies:
 libgnome-keyring                                      x86_64                                      3.12.0-1.el7                                            base                                      109 k
 perl-Error                                            noarch                                      1:0.17020-2.el7                                         base                                       32 k
 perl-Git                                              noarch                                      1.8.3.1-13.el7                                          base                                       54 k
 perl-TermReadKey                                      x86_64                                      2.30-20.el7                                             base                                       31 k
 rsync                                                 x86_64                                      3.1.2-4.el7                                             base                                      403 k

Transaction Summary
===========================================================================================================================================================================================================
Install  1 Package (+5 Dependent packages)

Total download size: 5.0 M
Installed size: 23 M
Downloading packages:
(1/6): libgnome-keyring-3.12.0-1.el7.x86_64.rpm                                                                                                                                     | 109 kB  00:00:00
(2/6): perl-Error-0.17020-2.el7.noarch.rpm                                                                                                                                          |  32 kB  00:00:00
(3/6): perl-Git-1.8.3.1-13.el7.noarch.rpm                                                                                                                                           |  54 kB  00:00:00
(4/6): perl-TermReadKey-2.30-20.el7.x86_64.rpm                                                                                                                                      |  31 kB  00:00:00
(5/6): rsync-3.1.2-4.el7.x86_64.rpm                                                                                                                                                 | 403 kB  00:00:00
(6/6): git-1.8.3.1-13.el7.x86_64.rpm                                                                                                                                                | 4.4 MB  00:00:01
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Total                                                                                                                                                                      3.9 MB/s | 5.0 MB  00:00:01
Running transaction check
Running transaction test
Transaction test succeeded
Running transaction
  Installing : 1:perl-Error-0.17020-2.el7.noarch                                                                                                                                                       1/6
  Installing : rsync-3.1.2-4.el7.x86_64                                                                                                                                                                2/6
  Installing : perl-TermReadKey-2.30-20.el7.x86_64                                                                                                                                                     3/6
  Installing : libgnome-keyring-3.12.0-1.el7.x86_64                                                                                                                                                    4/6
  Installing : perl-Git-1.8.3.1-13.el7.noarch                                                                                                                                                          5/6
  Installing : git-1.8.3.1-13.el7.x86_64                                                                                                                                                               6/6
  Verifying  : libgnome-keyring-3.12.0-1.el7.x86_64                                                                                                                                                    1/6
  Verifying  : perl-TermReadKey-2.30-20.el7.x86_64                                                                                                                                                     2/6
  Verifying  : git-1.8.3.1-13.el7.x86_64                                                                                                                                                               3/6
  Verifying  : perl-Git-1.8.3.1-13.el7.noarch                                                                                                                                                          4/6
  Verifying  : rsync-3.1.2-4.el7.x86_64                                                                                                                                                                5/6
  Verifying  : 1:perl-Error-0.17020-2.el7.noarch                                                                                                                                                       6/6

Installed:
  git.x86_64 0:1.8.3.1-13.el7

Dependency Installed:
  libgnome-keyring.x86_64 0:3.12.0-1.el7       perl-Error.noarch 1:0.17020-2.el7       perl-Git.noarch 0:1.8.3.1-13.el7       perl-TermReadKey.x86_64 0:2.30-20.el7       rsync.x86_64 0:3.1.2-4.el7

Complete!
[root@iZm5eat7o13nmw3p7hg674Z]~#
```

git 也安装完了, 这回应该可以安装 oh-my-zsh 了吧. 

```shell
[root@iZm5eat7o13nmw3p7hg674Z]~# sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
Cloning Oh My Zsh...
Cloning into '/root/.oh-my-zsh'...
remote: Counting objects: 864, done.
remote: Compressing objects: 100% (727/727), done.
remote: Total 864 (delta 16), reused 777 (delta 10), pack-reused 0
Receiving objects: 100% (864/864), 576.64 KiB | 245.00 KiB/s, done.
Resolving deltas: 100% (16/16), done.
Looking for an existing zsh config...
Using the Oh My Zsh template file and adding it to ~/.zshrc
         __                                     __
  ____  / /_     ____ ___  __  __   ____  _____/ /_
 / __ \/ __ \   / __ `__ \/ / / /  /_  / / ___/ __ \
/ /_/ / / / /  / / / / / / /_/ /    / /_(__  ) / / /
\____/_/ /_/  /_/ /_/ /_/\__, /    /___/____/_/ /_/
                        /____/                       ....is now installed!


Please look over the ~/.zshrc file to select plugins, themes, and options.

p.s. Follow us at https://twitter.com/ohmyzsh.

p.p.s. Get stickers and t-shirts at https://shop.planetargon.com.

➜  ~
```

靠, 终于给我装完了. 

看一下效果. 

![](https://user-images.githubusercontent.com/17526777/41191411-9217b510-6c21-11e8-8b3c-ad4a71804f9b.png)