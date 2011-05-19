<?php
/**
 * タクソノミーにBooksの項目を追加するタクソノミーモジュール
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
class Wtf_Taxonomy_Books extends Wtf_Taxonomy
{
    /**
     * {@inheritDoc}
     */
    protected $m_id = 'books';
    /**
     * {@inheritDoc}
     */
    protected $m_type = array('post', 'books');
    /**
     * {@inheritDoc}
     */
    protected $m_hierarchical = true;
    /**
     * {@inheritDoc}
     */
    protected $m_update_count_callback = '_update_post_term_count';
    /**
     * {@inheritDoc}
     */
    protected $m_label = '本のカテゴリ';
    /**
     * {@inheritDoc}
     */
    protected $m_singular_label = '本のカテゴリ';
    /**
     * {@inheritDoc}
     */
    protected $m_public = true;
    /**
     * {@inheritDoc}
     */
    protected $m_show_ui = true;

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return '本に関するカスタムタクソノミーを追加します。';
    }
}
