<?php
/**
 * カスタムフィールドを定義する為の抽象クラス
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
abstract class Wtf_Field implements Wtf_IModule
{
    protected $m_id;
    protected $m_title;
    protected $m_posttype = 'post';
    protected $m_context = 'normal';
    protected $m_priority = 'low';

    public function register()
    {
        add_action('admin_init', array($this, 'register_admin'));
    }
    
    public function register_admin()
    {
        $options = array();

        $htmlid = $this->m_id . '_meta';
    
        add_meta_box($htmlid, $this->m_title, array($this, 'displayPanel'), $this->m_posttype, $this->m_context, $this->m_priority);
        add_action('save_post', array($this, 'save'));
    }
    
    public function displayPanel() {}
    
    public function save($post_id) {}
}
