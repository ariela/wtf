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
class Wtf_Type_Books extends Wtf_Type
{
    protected $m_type = 'books';
    protected $m_labels = array(
        'name' => '本',
        'singular_name' => '本',
    );
    protected $m_public = true;
    protected $m_menu_position = 5;
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

    public static function description()
    {
        return '本に関するカスタム投稿タイプを追加します。';
    }
}