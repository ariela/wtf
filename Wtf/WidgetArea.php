<?php
/**
 * ウィジェット領域モジュールを定義する為の抽象クラス
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
abstract class Wtf_WidgetArea implements Wtf_IModule
{
    protected $m_id;
    protected $m_name;
    protected $m_description;
    protected $m_widget_before = '<section id="%1$s" class="widget %2$s">';
    protected $m_widget_after = '</section>';
    protected $m_title_before = '<header><h1>';
    protected $m_title_after = '</h1></header>';

    /**
     * ウィジェットを登録する関数
     */
    public function register()
    {
        $widget = array(
            'id' => $this->m_id,
            'name' => $this->m_name,
            'description' => $this->m_description,
            'before_widget' => $this->m_widget_before,
            'after_widget' => $this->m_widget_after,
            'before_title' => $this->m_title_before,
            'after_title' => $this->m_title_after,
        );
        register_sidebar($widget);
    }

    public static function description()
    {
        $c = get_called_class();
        $d = new $c;
        return $d->m_description;
    }
}