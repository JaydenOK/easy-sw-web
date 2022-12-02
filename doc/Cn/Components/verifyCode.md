---
title: easyswoole图片验证码
meta:
  - name: description
    content: easyswoole图片验证码
  - name: keywords
    content: easyswoole图片验证码|swoole图片验证码
---
# EasySwoole 验证码组件  

`EasySwoole` 提供了独立的 `验证码组件` ，几行代码即可实现输出一个验证码，支持用户自定义验证码字体

## 组件要求

- php: >=7.1
- ext-gd: *
- easyswoole/spl: ^1.0

## 安装方法

> composer require easyswoole/verifycode=3.x

## 仓库地址
[easyswoole/verifycode=3.x](https://github.com/easy-swoole/verifyCode)


## 基本使用  

### 配置

生成验证码前需要传入 `\EasySwoole\VerifyCode\Conf` 的对象实例，`\EasySwoole\VerifyCode\Conf` 类实例化后会有默认配置，无需配置也可生成验证码图片。

下面是 `\EasySwoole\VerifyCode\Conf` 类提供的相关配置方法。

```php
<?php
// +----------------------------------------------------------------------
// | easySwoole [ use swoole easily just like echo "hello world" ]
// +----------------------------------------------------------------------
// | WebSite: https://www.easyswoole.com
// +----------------------------------------------------------------------
// | Welcome Join QQGroup 853946743
// +----------------------------------------------------------------------

namespace EasySwoole\VerifyCode;

use EasySwoole\Spl\SplBean;

/**
 * 验证码配置文件
 * Class VerifyCodeConf
 * @author  : evalor <master@evalor.cn>
 * @package Vendor\VerifyCode
 */
class Conf extends SplBean
{

    public $charset   = '1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz'; // 字母表
    public $useCurve  = false;         // 混淆曲线
    public $useNoise  = false;         // 随机噪点
    public $useFont   = null;          // 指定字体
    public $fontColor = null;          // 字体颜色
    public $backColor = null;          // 背景颜色
    public $imageL    = null;          // 图片宽度
    public $imageH    = null;          // 图片高度
    public $fonts     = [];            // 额外字体
    public $fontSize  = 25;            // 字体大小
    public $length    = 4;             // 生成位数
    public $mime      = MIME::PNG;     // 设置类型
    public $temp      = '/tmp';  // 设置缓存目录

    public function setTemp($temp){
        if (!is_dir($temp)) mkdir($temp,0755) && chmod($temp,0755);
        $this->temp = $temp;
    }

    /**
     * 设置图片格式
     * @param $MimeType
     * @author : evalor <master@evalor.cn>
     * @return Conf
     */
    public function setMimeType($MimeType)
    {
        $allowMime = [ MIME::PNG, MIME::GIF, MIME::JPG ];
        if (in_array($MimeType, $allowMime)) $this->mime = $MimeType;
        return $this;
    }

    /**
     * 设置字符集
     * @param string $charset
     * @return Conf
     */
    public function setCharset($charset)
    {
        is_string($charset) && $this->charset = $charset;
        return $this;
    }

    /**
     * 开启混淆曲线
     * @param bool $useCurve
     * @return Conf
     */
    public function setUseCurve($useCurve = true)
    {
        is_bool($useCurve) && $this->useCurve = $useCurve;
        return $this;
    }

    /**
     * 开启噪点生成
     * @param bool $useNoise
     * @return Conf
     */
    public function setUseNoise($useNoise = true)
    {
        is_bool($useNoise) && $this->useNoise = $useNoise;
        return $this;
    }

    /**
     * 使用自定义字体
     * @param string $useFont
     * @return Conf
     */
    public function setUseFont($useFont)
    {
        is_string($useFont) && $this->useFont = $useFont;
        return $this;
    }

    /**
     * 设置文字颜色
     * @param array|string $fontColor
     * @return Conf
     */
    public function setFontColor($fontColor)
    {
        if (is_string($fontColor)) $this->fontColor = $this->HEXToRGB($fontColor);
        if (is_array($fontColor)) $this->fontColor = $fontColor;
        return $this;
    }

    /**
     * 设置背景颜色
     * @param null $backColor
     * @return Conf
     */
    public function setBackColor($backColor)
    {
        if (is_string($backColor)) $this->backColor = $this->HEXToRGB($backColor);
        if (is_array($backColor)) $this->backColor = $backColor;
        return $this;
    }

    /**
     * 设置图片宽度
     * @param int|string $imageL
     * @return Conf
     */
    public function setImageWidth($imageL)
    {
        $this->imageL = intval($imageL);
        return $this;
    }

    /**
     * 设置图片高度
     * @param null $imageH
     * @return Conf
     */
    public function setImageHeight($imageH)
    {
        $this->imageH = intval($imageH);
        return $this;
    }

    /**
     * 设置字体集
     * @param array|string $fonts
     * @return Conf
     */
    public function setFonts($fonts)
    {
        if (is_string($fonts)) array_push($this->fonts, $fonts);
        if (is_array($fonts) && !empty($fonts)) {
            if (empty($this->fonts)) {
                $this->fonts = $fonts;
            } else {
                array_merge($this->fonts, $fonts);
            }
        }
        return $this;
    }

    /**
     * 设置字体尺寸
     * @param int $fontSize
     * @return Conf
     */
    public function setFontSize($fontSize)
    {
        $this->fontSize = intval($fontSize);
        return $this;
    }

    /**
     * 设置验证码长度
     * @param int $length
     * @return Conf
     */
    public function setLength($length)
    {
        $this->length = intval($length);
        return $this;
    }

    /**
     * 获取配置值
     * @param $name
     * @author : evalor <master@evalor.cn>
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * 十六进制转RGB
     * @param $hexColor
     * @author : evalor <master@evalor.cn>
     * @return array
     */
    function HEXToRGB($hexColor)
    {
        $color = str_replace('#', '', $hexColor);
        if (strlen($color) > 3) {
            $rgb = array(
                hexdec(substr($color, 0, 2)),
                hexdec(substr($color, 2, 2)),
                hexdec(substr($color, 4, 2))
            );
        } else {
            $color = $hexColor;
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = array(
                hexdec($r),
                hexdec($g),
                hexdec($b)
            );
        }
        return $rgb;
    }
}
```

### 配置方法

需要对验证码进行自定义配置可以使用上文提到的组件提供的 `\EasySwoole\VerifyCode\Conf` 类进行动态配置。

```php
use EasySwoole\VerifyCode\Conf;
$Conf = new Conf();
```

#### 设置字符集合

可以自定义验证码生成时使用的字符集合，设置后从集合中随机选取，不设置则从 `[0-9A-Za-z]` 中随机选取

```php
$Conf->setCharset('123456ABCD');
```

#### 设置背景色

设置验证码的背景颜色，不设置则默认使用白色，支持使用完整 HEX、缩写 HEX 和 RGB 值设置

```php
$Conf->setBackColor('#3A5FCD');
$Conf->setBackColor('CCC');
$Conf->setBackColor([30, 144, 255]);
```

#### 设置文字颜色

设置验证码的文字颜色，不设置则随机生成一个颜色，支持使用完整 HEX、缩写 HEX 和 RGB 值设置

```php
$Conf->setFontColor('#3A5FCD');
$Conf->setFontColor('CCC');
$Conf->setFontColor([30, 144, 255]);
```   
  
#### 设置混淆

支持两种混淆方式，默认两种混淆都是关闭的，需要手动开启
```php
// 开启或关闭混淆曲线
$Conf->setUseCurve();
// 开启或关闭混淆噪点
$Conf->setUseNoise();
```     
     
#### 设置字体
默认验证码类已经带有 6 种字体，如果需要增加自己的字体库来提高识别难度，或者指定使用的字体，可以进行如下设置，注意字体路径需要使用绝对路径，即文件的完整路径

```php
// 增加单个字体传入路径字符串
$Conf->setFonts('path/to/file.ttf');
// 增加多个字体传入路径的数组
$Conf->setFonts(['path/to/file1.ttf', 'path/to/file2.ttf']);
// 指定生成使用的字体文件
$Conf->setUseFont('path/to/file.ttf');
```

#### 其他设置

可以指定验证码图片宽高，字体大小，随机生成的验证码位数等

```php
// 设置验证码图片的宽度
$Conf->setImageWidth(400);
// 设置验证码图片的高度
$Conf->setImageHeight(200);
// 设置生成字体大小
$Conf->setFontSize(30);
// 设置生成验证码位数
$Conf->setLength(4);
```     
     
#### 链式调用

为了更流畅的进行设置，所有的配置项均支持链式调用

```php
$Conf = new Conf();
$Conf->setUseNoise()->setUseCurve()->setFontSize(30);
```    
     
可以使用上方的动态配置，将设置好的配置类传入给验证码类。

```php
$Conf = new \EasySwoole\VerifyCode\Conf();
$Conf->setFontSize(30);
$VCode = new \EasySwoole\VerifyCode\VerifyCode($Conf);
```
 
> 如果配置比较多，也需要全站统一验证码配置，可以将验证码的配置放入配置文件，在生成时读取配置，验证码的配置类继承自 `\EasySwoole\Spl\SplBean`，可以在设置好后使用配置类的 `toArray` 方法直接获得配置数组，实例化验证码时，读取数组重新生成 `\EasySwoole\VerifyCode\Conf` 类即可。

### 验证码生成
 
::: warning 
  `\EasySwoole\VerifyCode\VerifyCode` 验证码操作类，如果不传入 `\EasySwoole\VerifyCode\Conf` 实例，则自动实例化一个 `\EasySwoole\VerifyCode\Conf` 实例。
:::
  
```php
<?php
$config = new \EasySwoole\VerifyCode\Conf([
    // 以下配置均为可选配置，用户可根据需求自行配置
    # 'charset'  => '1234567890AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz', # 设置验证码字符集合，默认为 数字 + 大小写字母
    # 'useCurve'  => false, # 设置不开启 混淆曲线，默认不开启
    # 'useNoise'  => false, # 设置不开启 随机噪点，默认不开启
    # 'useFont'   => null,  # 设置验证码使用的字体，默认随机获取内置字体
    # 'fontColor' => null,  # 设置 字体颜色，默认随机获取，支持使用完整 HEX，缩写 HEX 和 RGB 值设置
    # 'backColor' => null,  # 设置 背景颜色，默认白色，支持使用完整 HEX，缩写 HEX 和 RGB 值设置
    # 'imageL'    => null,  # 设置 验证码宽度，默认 162.5px
    # 'imageH'    => null,  # 设置 验证码高度，默认 50px
    # 'fonts'     => [],    # 设置 验证码可能使用的字体集合，默认组件内置支持 5 种
    # 'fontSize'  => 25,    # 设置 验证码字体大小，默认 25px
    # 'length'    => 4,     # 设置 验证码位数，默认 4 位
]);

# 使用方法单独配置 和 上述在构造函数中配置 等价
// 设置验证码长度为 4 【其他配置方法请看上文 \EasySwoole\VerifyCode\Conf 类】
# $config->setLength(4);

$code = new \EasySwoole\VerifyCode\VerifyCode($config);
$code->DrawCode();// 生成验证码，返回一个 \EasySwoole\VerifyCode\Result 对象
```

### 验证码结果类
验证码结果类，由 `VerifyCode` 验证码操作类调用 `DrawCode()` 方法时创建并返回。

下面是 `\EasySwoole\VerifyCode\Result` 类的具体实现，可获取创建验证码之后得到相关结果。

```php
<?php
// +----------------------------------------------------------------------
// | easySwoole [ use swoole easily just like echo "hello world" ]
// +----------------------------------------------------------------------
// | WebSite: https://www.easyswoole.com
// +----------------------------------------------------------------------
// | Welcome Join QQGroup 853946743
// +----------------------------------------------------------------------

namespace EasySwoole\VerifyCode;

/**
 * 验证码结果类
 * Class Result
 * @author : evalor <master@evalor.cn>
 * @package easySwoole\VerifyCode
 */
class Result
{
    private $captchaByte;  // 验证码图片
    private $captchaMime;  // 验证码类型
    private $captchaCode;  // 验证码内容
    private $createTime;

    function __construct($Byte, $Code, $Mime)
    {
        $this->captchaByte = $Byte;
        $this->captchaMime = $Mime;
        $this->captchaCode = $Code;
        $this->createTime = time();
    }

    function getCreateTime():int
    {
        return $this->createTime;
    }

    function getCodeHash($code = null,$time = null)
    {
        if(!$code){
            $code = $this->captchaCode;
        }
        if(!$time){
            $time = $this->createTime;
        }
        return substr(md5($code.$time),8,16);
    }

    /**
     * 获取验证码图片
     * @author : evalor <master@evalor.cn>
     * @return mixed
     */
    function getImageByte()
    {
        return $this->captchaByte;
    }

    /**
     * 返回图片Base64字符串
     * @author : evalor <master@evalor.cn>
     * @return string
     */
    function getImageBase64()
    {
        $base64Data = base64_encode($this->captchaByte);
        $Mime = $this->captchaMime;
        return "data:{$Mime};base64,{$base64Data}";
    }

    /**
     * 获取验证码内容
     * @author : evalor <master@evalor.cn>
     * @return mixed
     */
    function getImageCode()
    {
        return $this->captchaCode;
    }

    /**
     * 获取Mime信息
     * @author : evalor <master@evalor.cn>
     */
    function getImageMime()
    {
        return $this->captchaMime;
    }
}
```

### 使用示例
```php
<?php
/**
 * Created by PhpStorm.
 * User: Apple
 * Date: 2018/11/12 0012
 * Time: 16:30
 */

namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\VerifyCode\Conf;

class VerifyCode extends Controller
{
    function index()
    {
        // 配置验证码
        $config = new Conf();
        $code = new \EasySwoole\VerifyCode\VerifyCode($config);

        // 生成验证码
        $drawCode = $code->DrawCode();

        // 获取生成的验证码内容字符串 string(4) "0rnh"
        // 可存储起来和用户输入的验证码比对
        $codeStr = $drawCode->getImageCode();

        // 设置响应文件内容类型
        $this->response()->withHeader('Content-Type','image/png');

        // 向客户端输出验证码图片
        $this->response()->write($drawCode->getImageByte());
    }

    function getBase64()
    {
        // 配置验证码
        $config = new Conf();
        $code = new \EasySwoole\VerifyCode\VerifyCode($config);

        // 生成验证码
        $drawCode = $code->DrawCode();

        // 获取生成的验证码内容字符串 string(4) "0rnh"
        // 可存储起来和用户输入的验证码比对
        $codeStr = $drawCode->getImageCode();

        // 向客户端输出验证码的 base64 编码，前端可用来生成图片
        $this->response()->write($drawCode->getImageBase64());
    }
}
```

访问 `http://localhost:9501/VerifyCode/index` (示例请求地址) 即可看到验证码图片，访问 `http://localhost:9501/VerifyCode/getBase64` (示例请求地址) 即可得到验证码图片的 `base64` 编码结果。

## 进阶使用

生成二维码图片并返回，然后进行校验。

首先新建一个验证码工具类 `\App\Utility\VerifyCodeTools`，内容如下所示：

```php
<?php
/**
 * User: luffyQAQ
 * Date: 2019/9/5 15:29
 * Email: <1769360227@qq.com>
 */

namespace App\Utility;


class VerifyCodeTools
{
    const DURATION = 5 * 60;

    // 校验验证码
    public static function checkVerifyCode($code, $time, $hash)
    {
        if ($time + self::DURATION < time()) {
            return false;
        }
        $code = strtolower($code);
        return self::getVerifyCodeHash($code, $time) == $hash;
    }

    // 生成验证码 hash 字符串
    public static function getVerifyCodeHash($code, $time)
    {
        return md5($code . $time);
    }
}
```

生成验证码及对验证码进行校验。

```php
<?php
/**
 * User: luffyQAQ
 * Date: 2019/9/5 15:29
 * Email: <1769360227@qq.com>
 */

namespace App\HttpController;

use App\Utility\VerifyCodeTools;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Http\Message\Status;
use EasySwoole\Utility\Random;
use EasySwoole\VerifyCode\Conf;

class VerifyCode extends Controller
{
    static $VERIFY_CODE_TTL = 120;
    static $VERIFY_CODE_LENGTH = 4;

    // 生成验证码
    public function verifyCode()
    {
        // 配置验证码
        $config = new Conf();
        $code = new \EasySwoole\VerifyCode\VerifyCode($config);
        
        // 获取随机数(即验证码的具体值)
        $random = Random::character(self::$VERIFY_CODE_LENGTH, '1234567890abcdefghijklmnopqrstuvwxyz');
        // var_dump($random);    string(4) "m02t"
        
        // 绘制验证码
        $code = $code->DrawCode($random);
        
        // 获取验证码的 base64 编码及设置验证码有效时间
        $time = time();
        $result = [
            'verifyCode' => $code->getImageBase64(), // 得到绘制验证码的 base64 编码字符串
            'verifyCodeTime' => $time,
        ];

        // 将验证码加密存储在 Cookie 中，方便进行后续验证。用户也可以把验证码保存在 Session 或者 Redis中，方便后续验证。
        $this->response()->setCookie("verifyCodeHash", VerifyCodeTools::getVerifyCodeHash($random, $time), $time + self::$VERIFY_CODE_TTL, '/');
        $this->response()->setCookie('verifyCodeTime', $time, $time + self::$VERIFY_CODE_TTL, '/');
        $this->writeJson(Status::CODE_OK, $result, 'success');
    }

    // 校验验证码
    public function checkVerifyCode()
    {
        $code = $this->request()->getRequestParam('code');
        $verifyCodeHash = $this->request()->getRequestParam('verifyCodeHash');
        $verifyCodeTime = $this->request()->getRequestParam('verifyCodeTime');
        if (!VerifyCodeTools::checkVerifyCode($code, $verifyCodeTime, $verifyCodeHash)) {
            $this->writeJson(Status::CODE_OK, '验证码错误!', []);
            return false;
        }
        $this->writeJson(Status::CODE_OK, '验证码正确!', []);
    }
}


```
::: warning 
  调用对应的路径接口(即访问 `http://localhost:9501/VerifyCode/verifyCode` [示例请求地址])，即可实现前台验证码显示。在 `http://localhost:9501/VerifyCode/checkVerifyCode` [示例请求地址] 接口中传递参数即可校验验证码是否正确。
:::
