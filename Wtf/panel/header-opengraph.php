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
/*
  // このファイルのURLを作成
  $url = 'http';
  if (isset($_SERVER['HTTPS'])) $url .= 's';
  $url.= '://' . $_SERVER['SERVER_NAME'];
  if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] !== '80') {
  $url.=':' . $_SERVER['SERVER_PORT'];
  }
  $url.=$_SERVER['SCRIPT_NAME'];
  if (isset($_SERVER['QUERY_STRING'])) $url.= '?' . $_SERVER['QUERY_STRING'];
 */
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
        $id = isset($_POST['wtf_header_og_fbconnect_id']) ? $_POST['wtf_header_og_fbconnect_id'] : '';
        $type = isset($_POST['wtf_header_og_fbconnect']) ? $_POST['wtf_header_og_fbconnect'] : '0';

        update_option('wtf_header_og_fbconnect_id', $id);
        update_option('wtf_header_og_fbconnect', $type);
    }
}

$id = get_option('wtf_header_og_fbconnect_id', '');
$tp = get_option('wtf_header_og_fbconnect', '0');
?>

<div id="icon-themes" class="icon32"><br></div>

<h2>OpenGraph ヘッダモジュール設定</h2>

<?php if (isset($_POST['action'])) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"><p>
            <strong>設定を更新しました。</strong>
        </p></div>
<?php } ?>

<form method="post" action=""> 
    <input type='hidden' name='option_page' value='general' />
    <input type="hidden" name="action" value="update" />
    <?php wp_nonce_field($url); ?>

    <h3 class="title">Facebook</h3>
    <table class="form-table">
        <tr valign="top">
            <th scope="row">連携設定</th>
            <td><label>
                    <select id="wtf_header_og_fbconnect" name="wtf_header_og_fbconnect">
                        <option value="0"<?php if ($tp === '0')
            echo ' selected="selected" ' ?>>連携設定無し</option>                    
                        <option value="1"<?php if ($tp === '1')
                                    echo ' selected="selected" ' ?>>ユーザ連携</option>                    
                        <option value="2"<?php if ($tp === '2')
                                    echo ' selected="selected" ' ?>>アプリ連携</option>                    
                    </select>
                    <span class="description">連携方法を選択する</span>
                </label><br>
                <label>
                    <input id="wtf_header_og_fbconnect_id" name="wtf_header_og_fbconnect_id" type="text" value="<?php echo $id; ?>" >
                    <span class="description">ユーザ連携の場合はユーザID、アプリ連携の場合はアプリIDを設定する。</span>
                </label></td>
        </tr>
    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="変更を保存">
    </p>
</form>
