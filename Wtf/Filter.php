<?php
/**
 * フィルターモジュールを定義する為の抽象クラス
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
abstract class Wtf_Filter implements Wtf_IModule
{
    /**
     * [必須] フックするフィルター名
     * @var string
     */
    protected $m_tag;
    /**
     * [必須] フィルターが適応された時に実行するコールバック関数
     * @var callback
     */
    protected $m_callback;
    /**
     * [オプション：10] アクションを実行する関数の順序。
     * 数値が小さいほど早く実行され、同じ数値の場合は追加された順序で実行される。
     * @var integer
     */
    protected $m_priority = 10;
    /**
     * [オプション：1] 関数が受け付ける引数の数。
     * @var integer
     */
    protected $m_accepted_args = 1;

    /**
     * フィルターを登録する。
     */
    public function register()
    {
        add_filter($this->m_tag, $this->m_callback, $this->m_priority, $this->m_accepted_args);
    }
}
