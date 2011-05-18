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
class Wtf_Taxonomy_Books extends Wtf_Taxonomy
{
    protected $m_id = 'books';
    protected $m_type = array('post', 'books');
    protected $m_hierarchical = true;
    protected $m_update_count_callback = '_update_post_term_count';
    protected $m_label = '本のカテゴリ';
    protected $m_singular_label = '本のカテゴリ';
    protected $m_public = true;
    protected $m_show_ui = true;

    public static function description()
    {
        return '本に関するカスタムタクソノミーを追加します。';
    }
}
