<?php
class Wtf_ShortCode_Example extends Wtf_ShortCode
{
    protected $m_id = 'example';
    protected $m_callback;

    public function __construct()
    {
        $this->m_callback = array($this, 'callback');
    }

    public function callback($attrs)
    {
        $hoge = isset($attrs['hoge']) ? $attrs['hoge'] : 'none';
        $fuga = isset($attrs['fuga']) ? $attrs['fuga'] : 'none';
        return "{$hoge} & {$fuga}";
    }

    public static function description()
    {
        return 'ショートコードのサンプルです。';
    }
}