https://docs.gitlab.com/runner/install/linux-manually.html

在 `5. Install and run as service:` 这一步的命令中

```bash
gitlab-runner install --user=gitlab-runner --working-directory=/home/gitlab-runner
```

之前我都是无脑地 copy & paste 然后运行，但是发现

```bash
gitlab-runner start
# 等价于 systemctl start gitlab-runner
```

但是卡住了，好一会之后，没有启动成功！？而且还没有相关的错误输出……

然后我就去 `/etc/systemd/system/gitlab-runner.service` 去看，
拿到服务启动命令（`*start*`）尝试直接运行。

然后就看到了问题所在，上面的 `--working-directory=/home/gitlab-runner` 写错了！
应该写成本地的 home 目录，应为 `/usr/home/gitlab-runner` ！

把 `gitlab-runner.service` 文件中的命令改成正确的就行了！

---

感慨：**不明白原理，真是非常头疼！**
