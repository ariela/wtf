<?php
/**
 * オープングラフのメタ情報を追加するフィルターモジュール
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
class Wtf_Header_OpenGraph extends Wtf_Header
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
        return 'ヘッダにOpenGraphのメタタグを追加します。';
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
        $p = get_post(get_the_ID());
        $p = substr($p->post_content, 0, 140);
        $meta = array(
            'og:site_name' => get_bloginfo('name'),
            'og:type' => (is_home() || is_front_page()) ? 'blog' : 'article',
            'og:title' => (is_home() || is_front_page()) ? 'トップページ' : get_the_title(),
            'og:description' => (is_home() || is_front_page()) ? get_bloginfo('description') : $p,
            'og:url' => (is_home() || is_front_page()) ? get_bloginfo('url') : get_permalink(),
        );

        // facebook連携設定
        $id = get_option('wtf_header_og_fbconnect_id', '');
        $tp = get_option('wtf_header_og_fbconnect', '0');
        if ($tp === '1') {
            $meta['fb:admins'] = $id;
        } elseif ($tp === '2') {
            $meta['fb:app_id'] = $id;
        }

        foreach ($meta as $k => $v) {
            echo '    <meta property="' . $k . '" content="' . $v . '">' . "\n";
        }
        echo "\n";
    }

    /**
     * 管理パネルを登録する
     */
    public function registerMenu()
    {
        add_submenu_page('wtf.php', 'OpenGraph', 'OpenGraph', 8, 'header-opengraph',
                array($this, 'displayPanel'));
    }

    /**
     * 管理パネルを表示する
     * @see ../panel/header-opengraph.php
     */
    public function displayPanel()
    {
        require_once dirname(dirname(__FILE__)) . '/panel/header-opengraph.php';
    }
}