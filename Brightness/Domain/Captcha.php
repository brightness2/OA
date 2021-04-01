<?php
class Domain_Captcha
{

    private static $codeKey = 'captchaCode';

    /**
     * 生成验证码以及图像
     *
     * @return void
     */
    public static function genCode()
    {
        $captchaObj = new  Tool_Captcha_Captcha();
        $captchaObj->createImage();
        $code =  $captchaObj->getCode();

        DI()->cache->set(self::$codeKey, strtolower($code)); #文件缓存code
        $captchaObj->outPut();
    }

    /**
     * 校验验证码
     *
     * @param string $code
     * @return void
     */
    public static function checkCode($code)
    {
        $res = DI()->cache->get(self::$codeKey);
        if (!$res) {
            return true;
        }
        return $res == strtolower($code);
    }
}
