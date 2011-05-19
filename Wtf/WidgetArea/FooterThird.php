<?php
/**
 * ウィジェット領域にthird領域を追加するウィジェット領域モジュール
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
class Wtf_WidgetArea_FooterThird extends Wtf_WidgetArea
{
    /**
     * {@inheritDoc}
     */
    protected $m_id = 'third';
    /**
     * {@inheritDoc}
     */
    protected $m_name = 'フッタ領域（右）';
    /**
     * {@inheritDoc}
     */
    protected $m_description = 'フッタに設定されるウィジェット領域。右に表示される。';
}