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

// このファイルのURLを作成
$url = 'http';
if (isset($_SERVER['HTTPS'])) $url .= 's';
$url.= '://' . $_SERVER['SERVER_NAME'];
if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] !== '80') {
    $url.=':' . $_SERVER['SERVER_PORT'];
}
$url.=$_SERVER['SCRIPT_NAME'];
if (isset($_SERVER['QUERY_STRING'])) $url.= '?' . $_SERVER['QUERY_STRING'];

// モジュール情報を読み込み
include dirname(dirname(__FILE__)) . '/Config/support.php';

// 更新があった場合
if (!empty($_POST)) {

    // nonce チェック
    $nonce = wp_create_nonce($url);
    if (!wp_verify_nonce($nonce, $url)) {
        // nonceチェックでエラーが発生した場合         
        echo '<div id="setting-error-settings_updated" class="updated settings-error">';
        echo '<p><strong>リクエストが不正です。更新されませんでした。</strong></p>';
        echo '</div>';
    } else {
        // 設定情報を登録する
        $opt = array();
        $module = array();
        foreach ($support as $k => $v) {
            $key = 'wtf_' . $k . '_';

            // 有効フラグ
            $enable = $key . 'enabled';
            if (isset($_POST[$enable])) {
                $opt[$enable] = $_POST[$enable];
            } else {
                $opt[$enable] = '0';
            }

            // 使用モジュール
            $list = dirname(dirname(__FILE__)) . '/' . $v[1] . '/*.php';
            $list = glob($list);
            foreach ($list as $line) {
                $line = basename($line, '.php');
                $mod = $key . $line;
                if (isset($_POST[$mod])) {
                    $opt[$mod] = $_POST[$mod];
                    if (empty($module[$v[1]])) $module[$v[1]] = array();
                    $module[$v[1]][] = 'Wtf_' . $v[1] . '_' . $line;
                } else {
                    $opt[$mod] = '0';
                }
            }
        }

        // 情報の登録
        update_option('wtf_modules', serialize($module));
        foreach ($opt as $k => $v) {
            update_option($k, $v);
        }
        // 再読み込み
        exit('<script>location.href="' . $url . '&m=1";</script>');
    }
}
?>
<div id="icon-themes" class="icon32"><br></div>

<h2>Wordpress Theme Framework 設定</h2>

<?php if (isset($_GET['m'])) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"><p>
            <strong>設定を更新しました。</strong>
        </p></div>
<?php } ?>

<form method="post" action=""> 
    <input type='hidden' name='option_page' value='general' />
    <input type="hidden" name="action" value="update" />


    <!--
    <input type="hidden" id="_wpnonce" name="_wpnonce" value="ed582380d2" />
    <input type="hidden" name="_wp_http_referer" value="/tr/wordpress/wp-admin/options-general.php" /> 
    -->

    <?php
    wp_nonce_field($url);
    foreach ($support as $k => $v) {
        wtfmenu_displayStack($v[0], $k, $v[1]);
    }
    ?>
</table>
<p class="submit">
    <input type="submit" name="submit" id="submit" class="button-primary" value="変更を保存">
</p>
</form>

<?php

function wtfmenu_displayStack($title, $slug, $type)
{
    $buf = array();

    $buf[] = '<h3 class="title">' . $title . '</h3>';
    $buf[] = '<table class="form-table">';
    $buf[] = '  <tr valign="top">';

    // 有効化オプション
    $t = 'wtf_' . $slug . '_enabled';
    $$t = get_option($t, '1');
    $buf[] = '    <th scope="row"><label for="' . $t . '">有効化</label></th>';
    $buf[] = '    <td><label>';
    if ($$t === '1') {
        $buf[] = '      <input name="' . $t . '" type="checkbox" id="' . $t . '" value="1" checked="checked">';
    } else {
        $buf[] = '      <input name="' . $t . '" type="checkbox" id="' . $t . '" value="1">';
    }
    $buf[] = '      有効';
    $buf[] = '    </label></td>';
    $buf[] = '  </tr>';
    $buf[] = '  <tr valign="top">';
    $buf[] = '    <th scope="row">利用モジュール</th>';
    $buf[] = '    <td>';

    $list = dirname(dirname(__FILE__)) . '/' . $type . '/*.php';
    $list = glob($list);
    foreach ($list as $line) {
        $line = basename($line, '.php');
        // オプション
        $t = 'wtf_' . $slug . '_' . $line;
        $$t = get_option($t, '0');

        $buf[] = '      <label>';
        if ($$t === '1') {
            $buf[] = '        <input id="' . $t . '" name="' . $t . '" type="checkbox" value="1" checked="checked">';
        } else {
            $buf[] = '        <input id="' . $t . '" name="' . $t . '" type="checkbox" value="1">';
        }


        $buf[] = '        ' . $line;

        $class = 'Wtf_' . $type . '_' . $line;
        $descript = call_user_func(array($class, 'description'));
        if (!empty($descript)) {
            $buf[] = '&nbsp;<span class="description">' . $descript . '</span>';
        }

        $buf[] = '      </label><br>';
    }
    $buf[] = '    </td>';
    $buf[] = '  </tr>';
    $buf[] = '</table>';

    echo implode("\n", $buf);
}