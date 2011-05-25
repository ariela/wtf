<?php
/**
 * Pagenateにrel=next属性を付加するフィルター
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
class Wtf_Filter_PaginateRelNext extends Wtf_Filter
{
    /**
     * {@inheritDoc}
     */
    protected $m_tag = 'next_posts_link_attributes';
    /**
     * {@inheritDoc}
     */
    protected $m_accepted_args = 1;

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'ページ切り替えリンクにrel=next属性を追加します。';
    }

    /**
     * クラスの初期化処理（コールバックの設定）
     */
    public function __construct()
    {
        $this->m_callback = array($this, 'callback');
    }

    /**
     * コールバック関数
     * @param string $attrs 次へページへのリンクタグに付加されている属性
     * @return string rel="next"を追加した属性
     */
    public function callback($attrs)
    {
        if (!empty($attrs)) $attrs .= ' ';
        return $attrs . 'rel="next"';
    }
}