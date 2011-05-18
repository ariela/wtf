<?php
/**
 * Copyright 2011 Takeshi Kawamoto
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
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