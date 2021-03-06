<?php
/**
 * プロフィールにTwitter/Facebookの項目を追加するフィルターモジュール
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
class Wtf_Filter_AppendContact extends Wtf_Filter
{
    /**
     * {@inheritDoc}
     */
    protected $m_tag = 'user_contactmethods';
    /**
     * {@inheritDoc}
     */
    protected $m_priority = 10;
    /**
     * {@inheritDoc}
     */
    protected $m_accepted_args = 1;

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'プロフィールにTwitter/Facebookの項目を追加します。';
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
     * @param array $contact コンタクト情報項目が設定された配列
     * @return array コンタクト情報項目配列
     */
    public function callback($contact)
    {
        $contact['twitter'] = 'Twitter';
        $contact['facebook'] = 'Facebook';
        return $contact;
    }
}