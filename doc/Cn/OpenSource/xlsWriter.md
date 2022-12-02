---
title: xlsWrite
meta:
  - name: description
    content: xlsWriter-excel解析项目
  - name: keywords
    content: easyswoole xlsWriter | easyswoole excel解析
---

# xlsWriter-excel解析项目

![logo](https://github.com/viest/php-ext-xlswriter/raw/master/resource/logo_now.png)  


## 为什么使用xlswriter

请参考下方对比图；由于内存原因，PHPExcel数据量`相对较大`的情况下无法正常工作，虽然可以通过`修改memory_limit`配置来解决内存问题，但完成工作的时间可能会更长;

![php-excel](https://github.com/viest/php-ext-xlswriter/raw/master/resource/performance_comparison.png)

xlswriter是一个 PHP C 扩展，可用于在 Excel 2007+ XLSX 文件中读取数据，插入多个工作表，写入文本、数字、公式、日期、图表、图片和超链接。

它具备以下特性：

###### 一、写入

* 100％兼容的Excel XLSX文件
* 完整的Excel格式
* 合并单元格
* 定义工作表名称
* 过滤器
* 图表
* 数据验证和下拉列表
* 工作表PNG/JPEG图像
* 用于写入大文件的内存优化模式
* 适用于Linux，FreeBSD，OpenBSD，OS X，Windows
* 编译为32位和64位
* FreeBSD许可证
* 唯一的依赖是zlib

###### 二、读取

* 完整读取数据
* 光标读取数据
* 按数据类型读取

## 从这里开始

[文档|Documents](https://xlswriter-docs.viest.me/)

## PECL 仓库

[![pecl](https://github.com/viest/php-ext-xlswriter/raw/master/resource/pecl.png)](https://pecl.php.net/package/xlswriter)

## IDE Helper

```bash
composer require viest/php-ext-xlswriter-ide-helper:dev-master
```


#### 基准测试

测试环境: Macbook Pro 13 inch, Intel Core i5, 16GB 2133MHz LPDDR3 Memory, 128GB SSD Storage.

##### 导出

> 两种内存模式导出100万行数据（单行27列，数据类型均为字符串，单个字符串长度为19）

* 普通模式：耗时 `29S`，内存只需 `2083MB`；
* 固定内存模式：仅需 `52S`，内存仅需 `<1MB`；

##### 导入

> 100万行数据（单行1列，数据类型为INT）

* 全量模式：耗时 `3S`，内存仅 `558MB`；
* 游标模式：耗时 `2.8S`，内存仅 `<1MB`；
