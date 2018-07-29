title: GitLab 自动化
date: 2018-12-01
categories: [Web]
tags: [Web]
description: Office Automatic &#58; 主要使用 API、CI 等。CI 即 Continuous Integration 持续集成。
---

和笔者正在进行的微博移动端 API 重构项目一样，同部门的其它项目 __在 GitLab 相关的工作流程上也有许多重复且固定的操作__，有同事也想要从这些琐碎中得到解放，去做更多更有意义的工作。于是，笔者做了相关的技术分享，准备讲稿的同时顺便撰成本文。

## 基本的工具

- 定时任务：
    - crontab：稳定，介绍语法
    - ~~GitLab Schedules：存在问题~~
- 网络请求：
    - curl：写成 bash 脚本
    - 各种语言、框架、组件包的 HTTP 请求方法
- 各种文档：
    - GitLab API
    - GitLab CI
    - GitLab CI Lint
- 其它：
    - 正则表达式：regex 简单的语法

---

## GitLab API

<https://docs.gitlab.com/ee/api/>

---

### All Branches

``` bash 使用
curl --header "PRIVATE-TOKEN: [private_token]" \
https://[gitlab_domain]/api/v4/projects/[project_id]/repository/branches
```

``` bash 实例
curl --header "PRIVATE-TOKEN: 9koXpg98eAheJpvBs5tK" \
https://gitlab.example.com/api/v4/projects/5/repository/branches
```

### Single Branch

``` bash 使用
curl --header "PRIVATE-TOKEN: [private_token]" \
https://[gitlab_domain]/api/v4/projects/[project_id]/repository/branches/[branch_name]
```

``` bash 实例
curl --header "PRIVATE-TOKEN: 9koXpg98eAheJpvBs5tK" \
https://gitlab.example.com/api/v4/projects/5/repository/branches/master
```

## GitLab CI

<https://docs.gitlab.com/ee/ci/>

配置文件：.gitlab-ci.yml

上一条指令执行错误，流程就退出了

### before_script

前置准备工作

### script

正式工作

### after_script

后续工作

---

## 项目辅助指令
- extends Symfony/Console/Command
    当前最新版本 3.3
    <https://symfony.com/doc/3.3/components/console.html>
    项目正在使用的版本 2.8
    <http://api.symfony.com/2.8/index.html>

- create 创建
    - mk:command
    - mk:controller
        - mk:controller_test
    - mk:trait
        - mk:trait_test
- check 代码检查
    - cs
        - cbf
    - lint
    - test
- migrate 迁移管理
    - ls:issue
- release 上线
    - mk:branch
    - mk:tag
    - mk:release_note
    - mk:release_mail
- clean 清理

---

## 项目代码自更新的 bash 脚本

bash & git

## 定时任务 crontab

特点：稳定、简单
修改：crontab -e
规则：如何定时
规则检查 <https://crontab.guru/>
命令文档 <http://crontab.org/> 或运行 `man crontab` 命令

## 自动上线

- 定时任务：crontab
    需要另一台服务
    sora 自己更新自己的代码
- 新建 Tag：sora mk:tag
    其实通常
    只是针对 master 分支来建仿真包 tag
    只是针对 master 或最新的仿真包 tag 来建正式包 tag
- 上线：CI Job -> Jenkins API
    - Tag 判断：tag regex
- 其它：
    - release note
    - release mail

---

## 定时清理不用的 tags 和 branches

注意根据实际需求来进行。
删除是为了在 jenkins 手动上线时，tag 不会太多，找起来不会太麻烦，而且太多了也容易选错。

## GitLab Webhook

<https://docs.gitlab.com/ce/user/project/integrations/webhooks.html>

### Event

issue
merge request、
pipeline、job、

### 应用

重试因 GitLab Runner 不稳定偶发 System Failed 错误而失败的 GitLab CI Job，这些错误通常跟代码无关，一般只要重试就能正常运行。

但是手动重试是没有必要的

---

## Git Issue

* Issue 模板
    [path/to/project/].gitlab/issue_templates/[^\.]+.md

### Board

管理需求、接口
白板

### 提测报告

### 需求跟踪

修改缘由、背景，负责人，测试人员，相关资料、MRs、其它 issues

### 过滤出所需 issue

其它

---

## Merge Request

* MR 模板
    (path/to/project/).gitlab/merge_request_templates/[^\.]+.md

### MR 更新

---

## GitLab Environment

可以知道代码有没有更新到「文档」，有没有发布到「仿真」环境，甚至「正式」环境

需要和 GitLab CI Job 配合