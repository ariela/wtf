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
        $id = isset($_POST['wtf_header_anl_id']) ? $_POST['wtf_header_anl_id'] : '';

        update_option('wtf_header_anl_id', $id);
    }
}

$id = get_option('wtf_header_anl_id', '');
?>

<div id="icon-themes" class="icon32"><br></div>

<h2>Google Analytics ヘッダモジュール設定</h2>

<?php if (isset($_POST['action'])) { ?>
    <div id="setting-error-settings_updated" class="updated settings-error"><p>
            <strong>設定を更新しました。</strong>
        </p></div>
<?php } ?>

<form method="post" action=""> 
    <input type='hidden' name='option_page' value='general' />
    <input type="hidden" name="action" value="update" />
    <?php wp_nonce_field($url); ?>

    <h3 class="title">アカウント設定</h3>
    <table class="form-table">

        <tr valign="top">
            <th scope="row"><label for="wtf_header_anl_id">アカウントID</label></th>
            <td>
                <input id="wtf_header_anl_id" name="wtf_header_anl_id" type="text" value="<?php echo $id; ?>">
                <span class="description">Google AnalyticsのユーザIDを設定する（UA-*-*）</span>
            </td>
        </tr>

    </table>
    <p class="submit">
        <input type="submit" name="submit" id="submit" class="button-primary" value="変更を保存">
    </p>
</form>
