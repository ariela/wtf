<?php
include dirname(dirname(__FILE__)) . '/Config/support.php';
if (!empty($_POST)) {
    $opt = array();
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
            } else {
                $opt[$mod] = '0';
            }
        }
    }

    foreach ($opt as $k => $v) {
        update_option($k, $v);
    }
}
?>
<div id="icon-themes" class="icon32"><br></div>

<h2>Wordpress Theme Framework 設定</h2>

<form method="post" action=""> 
    <input type='hidden' name='option_page' value='general' />
    <input type="hidden" name="action" value="update" />

    <!--
    <input type="hidden" id="_wpnonce" name="_wpnonce" value="ed582380d2" />
    <input type="hidden" name="_wp_http_referer" value="/tr/wordpress/wp-admin/options-general.php" /> 
    -->

    <?php
    foreach ($support as $k => $v) {
        wtfmenu_displayStack($v[0], $k, $v[1]);
    }
    ?>
</table>
<p class="submit">
    <input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes">
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
        $$t = get_option($t, '1');
        $buf[] = '      <label>';
        if ($$t === '1') {
            $buf[] = '        <input id="' . $t . '" name="' . $t . '" type="checkbox" value="1" checked="checked">';
        } else {
            $buf[] = '        <input id="' . $t . '" name="' . $t . '" type="checkbox" value="1">';
        }
        $buf[] = '        ' . $line;
        $buf[] = '      </label><br>';
    }
    $buf[] = '    </td>';
    $buf[] = '  </tr>';
    $buf[] = '</table>';

    echo implode("\n", $buf);
}