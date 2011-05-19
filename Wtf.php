<?php
/**
 * WordPress テーマ開発用フレームワーク 起動クラス
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
class Wtf
{
    /**
     * 自身のインスタンスを保持する
     * @var Wtf
     */
    private static $s_instance;

    /**
     * 自身以外からの初期化を禁止
     */
    private function __construct()
    {
        // include_pathの追加
        set_include_path(dirname(__FILE__) . PATH_SEPARATOR . get_include_path());
        // クラスローダの追加
        spl_autoload_register(array($this, 'classFileLoader'));

        $this->initializeTheme();
        $this->loadModule();
    }

    /**
     * インスタンスの複製を禁止
     */
    private function __clone()
    {
        
    }

    /**
     * 自身のインスタンスを取得する
     * @return Wtf 自身のインスタンス
     */
    public static function getInstance()
    {
        if (self::$s_instance === null) {
            self::$s_instance = new self();
        }
        return self::$s_instance;
    }

    /**
     * Wtfのクラスファイルを読み込む
     * @param string $className クラス名
     */
    public function classFileLoader($className)
    {
        if (0 === strncmp('Wtf', $className, 3)) {
            $classPath = str_replace('_', DIRECTORY_SEPARATOR, $className);
            $classPath .= '.php';
            include_once $classPath;
        }
    }

    /**
     * テーマの初期化を行う
     */
    private function initializeTheme()
    {
        //add_custom_image_header();
        //add_custom_background();
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('automatic-feed-links');

        // 不要なヘッダを取り除く
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'wp_generator');

        // Wtf管理ページの追加
        add_action('admin_menu', array($this, 'addWtfMenu'));
    }

    /**
     * Wtfの設定メニューを追加する
     */
    public function addWtfMenu()
    {
        add_menu_page('WTF設定', 'WTF設定', 8, 'wtf.php', array($this, 'displayWtfMenu'));
    }

    /**
     * Wtfの設定メニューを表示する
     */
    public function displayWtfMenu()
    {
        require_once dirname(__FILE__) . '/Wtf/panel/wtfmenu.php';
    }

    /**
     * モジュールを読み込む
     */
    private function loadModule()
    {
        // モジュール情報を取得する
        include dirname(__FILE__) . '/Wtf/Config/support.php';
        $modules = unserialize(get_option('wtf_modules'));

        foreach ($support as $short => $value) {
            // モジュール情報を構築する
            $optkey = 'wtf_' . $short . '_';
            $long = $value[1];
            $module = $modules[$long];
            $enable = get_option($optkey . 'enabled', 0);

            // モジュールが有効な場合は読み込みを行う
            if ($enable === '1' && !is_null($module)) {
                foreach ($module as $classname) {
                    $md = new $classname();
                    $md->register();
                }
            }
        }
    }
}