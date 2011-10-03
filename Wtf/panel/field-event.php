<?php
/**
 * フィールドモジュール「Events」の投稿画面パネル
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
if(!empty($custom[$this->m_key . '_start']) || !empty($custom[$this->m_key . '_end'])) {
    $event_start = $custom[$this->m_key . '_start'][0];
    $event_end = $custom[$this->m_key . '_end'][0];
    //日付だけ表示
    $event_date = date("Y-m-d", strtotime($event_start));
    //開始時間
    $start_time =  date("H:i", strtotime($event_start));
    //終了時間
    $end_time =  date("H:i", strtotime($event_end));
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
        <th>日付</th>
        <td><input name="<?php echo $this->m_key;?>_date" class="<?php echo $this->m_key;?>_date" id="datepicker" value="<?php if(isset ( $event_date)) echo $event_date; ?>" /></td>
    </tr>
    <tr>
        <th>時間</th>
        <td>
            <input name="<?php echo $this->m_key;?>_start_time" class="<?php echo $this->m_key;?>_start_time" value="<?php if(isset ( $start_time)) echo $start_time; ?>" /> ～
            <input name="<?php echo $this->m_key;?>_end_time" class="<?php echo $this->m_key;?>_end_time" value="<?php if(isset ( $end_time)) echo $end_time; ?>" />
        </td>
    </tr>
</table>
</div>
