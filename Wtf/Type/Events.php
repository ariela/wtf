<?php
/**
 * 投稿タイプにEventsの項目を追加する投稿タイプモジュール
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
 * @author   Takeshi Kawamoto <yuki@transrain.net>
 * @version  $Id:$
 * @since    1.0.0
 */
class Wtf_Type_Events extends Wtf_Type
{
    /**
     * {@inheritDoc}
     */
    protected $m_type = 'events';
    /**
     * {@inheritDoc}
     */
    protected $m_labels = array(
        'name' => 'イベント情報',
        'singular_name' => 'イベント情報',
    );
    /**
     * {@inheritDoc}
     */
    protected $m_public = true;
    /**
     * {@inheritDoc}
     */
    protected $m_menu_position = 5;
    /**
     * {@inheritDoc}
     */
    protected $m_supports = array(
        'title'
        , 'editor'
        , 'thumbnail'
        , 'custom-fields'
        , 'excerpt'
        , 'author'
        , 'trackbacks'
        , 'comments'
        , 'revisions'
        , 'page-attributes'
    );
    /**
     * {@inheritDoc}
     */
    protected $m_taxonomies = array('eventcategory', 'post_tag');
    protected $m_has_archive = 'events';

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'イベント情報に関するカスタム投稿タイプを追加します。';
    }
}