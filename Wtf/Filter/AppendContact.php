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
class Wtf_Filter_AppendContact extends Wtf_Filter
{
    protected $m_tag = 'user_contactmethods';
    protected $m_priority = 10;
    protected $m_accepted_args = 1;

    public function __construct()
    {
        $this->m_callback = array($this, 'callback');
    }

    public function callback($contact)
    {
        $contact['twitter'] = 'Twitter';
        $contact['facebook'] = 'Facebook';
        return $contact;
    }

    public static function description()
    {
        return 'プロフィールに項目を追加します。';
    }
}