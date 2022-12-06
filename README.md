# easy-swoole-web
easy-swoole-web

## 启动
```text
[root@ac_web easy_sw_web]# php easyswoole server start -d
  ______                          _____                              _
 |  ____|                        / ____|                            | |
 | |__      __ _   ___   _   _  | (___   __      __   ___     ___   | |   ___
 |  __|    / _` | / __| | | | |  \___ \  \ \ /\ / /  / _ \   / _ \  | |  / _ \
 | |____  | (_| | \__ \ | |_| |  ____) |  \ V  V /  | (_) | | (_) | | | |  __/
 |______|  \__,_| |___/  \__, | |_____/    \_/\_/    \___/   \___/  |_|  \___|
                          __/ |
                         |___/

main server                   SWOOLE_WEB
listen address                0.0.0.0
listen port                   9511
worker_num                    8
reload_async                  true
max_wait_time                 3
pid_file                      /root/easy_sw_web/Temp/pid.pid
log_file                      /root/easy_sw_web/Log/swoole.log
daemonize                     true
user                          root
swoole version                4.5.11
php version                   7.1.18
easyswoole version            3.5.1
run mode                      dev
temp dir                      /root/easy_sw_web/Temp
log dir                       /root/easy_sw_web/Log

[root@ac_web easy_sw_web]# php easyswoole process show
[2022-12-06 18:03:32][trigger][warning]:[Division by zero at file:/root/easy_sw_web/vendor/easyswoole/easyswoole/src/Command/DefaultCommand/Process.php line:119]
[2022-12-06 18:03:32][trigger][warning]:[Division by zero at file:/root/easy_sw_web/vendor/easyswoole/easyswoole/src/Command/DefaultCommand/Process.php line:120]
┌───────┬─────────────────────────┬───────────────────────┬─────────────┬─────────────────┬─────────────────────┬──────────────────────────────────┐
│  pid  │          name           │         group         │ memoryUsage │ memoryPeakUsage │     startUpTime     │               hash               │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28854 │ EasySwoole.Worker.0     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28855 │ EasySwoole.Worker.1     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28856 │ EasySwoole.Worker.2     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28857 │ EasySwoole.Worker.3     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28858 │ EasySwoole.Worker.4     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28859 │ EasySwoole.Worker.5     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28860 │ EasySwoole.Worker.6     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28861 │ EasySwoole.Worker.7     │ EasySwoole.Worker     │ 2.76 mb     │ 4 mb            │ 2022-12-06 18:01:32 │                                  │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28862 │ EasySwoole.TaskWorker.0 │ EasySwoole.TaskWorker │ 2.77 mb     │ 4 mb            │ 2022-12-06 18:01:32 │ 0000000014736a60000000000e0afc76 │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28863 │ EasySwoole.TaskWorker.1 │ EasySwoole.TaskWorker │ 2.77 mb     │ 4 mb            │ 2022-12-06 18:01:32 │ 0000000014736a63000000000e0afc76 │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28864 │ EasySwoole.TaskWorker.2 │ EasySwoole.TaskWorker │ 2.77 mb     │ 4 mb            │ 2022-12-06 18:01:32 │ 0000000014736a66000000000e0afc76 │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28865 │ EasySwoole.TaskWorker.3 │ EasySwoole.TaskWorker │ 2.77 mb     │ 4 mb            │ 2022-12-06 18:01:32 │ 0000000014736a69000000000e0afc76 │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28867 │ EasySwoole.Bridge       │ EasySwoole.Bridge     │ 2.78 mb     │ 4 mb            │ 2022-12-06 18:01:32 │ 0000000014736a71000000000e0afc76 │
├───────┼─────────────────────────┼───────────────────────┼─────────────┼─────────────────┼─────────────────────┼──────────────────────────────────┤
│ 28866 │ AsyncMessageProcess     │ AsyncMessageProcess   │ NAN b       │ NAN b           │ 2022-12-06 18:01:32 │ 0000000014736a0f000000000e0afc76 │
└───────┴─────────────────────────┴───────────────────────┴─────────────┴─────────────────┴─────────────────────┴──────────────────────────────────┘

```

