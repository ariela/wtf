<?php
/**
 * フィールドモジュール「CircleSpace」の投稿画面パネル
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
global $post;
$custom = get_post_custom($post->ID);

//メタキーがあったら
if(!empty($custom[$this->m_key . '_name']) || !empty($custom[$this->m_key . '_space'])) {
    $name = $custom[$this->m_key . '_name'][0];
    $space = $custom[$this->m_key . '_space'][0];
}

//入力フィールドの表示
?>
<input type="hidden" name="<?php echo $this->m_key;?>_nonce" id="<?php echo $this->m_key;?>_nonce" value="<?php echo wp_create_nonce($this->m_key . '_nonce');?>" />
<style type="text/css">
#event-meta table th {
        text-align: left;
        font-weight: normal;
        padding-right: 10px;
}
</style>
<div id="event-meta">
<table>
    <tr>
        <th>サークル名</th>
        <td><input name="<?php echo $this->m_key;?>_name" class="<?php echo $this->m_key;?>_name" value="<?php if(isset($name)) echo $name; ?>" /></td>
    </tr>
    <tr>
        <th>スペース</th>
        <td>
            <input name="<?php echo $this->m_key;?>_space" class="<?php echo $this->m_key;?>_space" value="<?php if(isset($space)) echo $space; ?>" /> 
        </td>
    </tr>
</table>
</div>
