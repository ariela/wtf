<?php
/**
 * ウィジェットモジュールを定義する為の抽象クラス
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
abstract class Wtf_Widget extends WP_Widget implements Wtf_IModule
{
    protected $m_title = 'title';

    public function __construct()
    {
        $c = get_class($this);
        parent::__construct($c, $this->m_title);
    }

    public function initialize()
    {
        $c = get_class($this);
        register_widget($c);
    }

    public function register()
    {
        add_action('widgets_init', array($this, 'initialize'));
    }
}