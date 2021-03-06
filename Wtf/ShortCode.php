<?php
/**
 * ショートコードモジュールを定義する為の抽象クラス
 *
 * License:
 * 
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
 * 
 * @author  Takeshi Kawamoto <yuki@transrain.net>
 * @version $Id:$
 * @since   1.0.0
 */
abstract class Wtf_ShortCode implements Wtf_IModule
{
    protected $m_id;
    protected $m_callback;

    public function register()
    {
        add_shortcode($this->m_id, $this->m_callback);
        if (method_exists($this, 'registerMenu')) {
            add_action('admin_menu', array($this, 'registerMenu'));
        }
    }
}