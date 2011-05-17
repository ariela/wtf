<?php
/**
 * テーマ開発用フレームワーク
 * 
 * @author    Takeshi Kawamoto
 * @category  WordPress
 * @package   Wtf
 * @copyright Copyright (c) Takeshi Kawamoto <yuki@transrain.net>
 * @license   <license>
 * @version   <version>
 * @link      <link>
 */
/**
 * テーマ用クラス
 */
final class Wtf
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

        include dirname(__FILE__) . '/Wtf/Config/support.php';
        foreach ($support as $k => $v) {
            if ($v) {
                $this->loadModule($k, $v[1]);
            }
        }
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
        add_submenu_page('themes.php', 'WTF設定', 'WTF設定', 8, 'wtfconfig',
                array($this, 'displayWtfMenu'));
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
     * @param string $type モジュールタイプ
     */
    private function loadModule($opt, $type)
    {
        $optkey = 'wtf_' . $opt . '_';
        $type = ucfirst($type);

        // enable
        $optenb = $optkey . 'enabled';
        $optenb = get_option($optenb, '0');

        if ($optenb === '1') {

            $path = dirname(__FILE__) . '/Wtf/' . $type . '/*.php';
            $list = glob($path);
            foreach ($list as $file) {
                $optmod = $optkey . basename($file, '.php');
                $optmod = get_option($optmod, '0');

                if ($optmod === '1') {
                    $classname = 'Wtf_' . $type . '_' . basename($file, '.php');
                    $module = new $classname();
                    $module->register();
                }
            }
        }
    }
}