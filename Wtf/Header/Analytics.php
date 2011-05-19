<?php
/**
 * Google Analyticsのメタ情報を追加するフィルターモジュール
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
class Wtf_Header_Analytics extends Wtf_Header
{
    /**
     * {@inheritDoc}
     */
    protected $m_priority = 10;
    /**
     * {@inheritDoc}
     */
    protected $m_accepted_args = 0;

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'ヘッダにGoogle Analyticsのスクリプトタグを追加します。';
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
     */
    public function callback()
    {

        $id = get_option('wtf_header_anl_id', '');
        $buf = array();

        $buf[] = '<script type="text/javascript">';
        $buf[] = 'var _gaq = _gaq || [];';
        $buf[] = '_gaq.push([\'_setAccount\', \'' . $id . '\']);';
        $buf[] = '_gaq.push([\'_trackPageview\']);';
        $buf[] = '(function() {';
        $buf[] = '    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;';
        $buf[] = '    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';';
        $buf[] = '    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);';
        $buf[] = '})();';
        $buf[] = '</script>';

        echo implode("\n", $buf) . "\n    ";
    }

    /**
     * 管理パネルを登録する
     */
    public function registerMenu()
    {
        add_submenu_page('wtf.php', 'Analytics', 'Analytics', 8, 'header-analytics',
                array($this, 'displayPanel'));
    }

    /**
     * 管理パネルを表示する
     * @see ../panel/header-analytics.php
     */
    public function displayPanel()
    {
        require_once dirname(dirname(__FILE__)) . '/panel/header-analytics.php';
    }
}