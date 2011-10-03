<?php
/**
 * フィールドにイベント日時の項目を追加するカスタムフィールドモジュール
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
class Wtf_Field_Events extends Wtf_Field
{
    /**
     * {@inheritDoc}
     */
    protected $m_id = 'events';
    /**
     * {@inheritDoc}
     */
    protected $m_title = 'イベント日時';
    /**
     * {@inheritDoc}
     */
    protected $m_posttype = 'events';
    /**
     * {@inheritDoc}
     */
    protected $m_context = 'side';
    /**
     * {@inheritDoc}
     */
    protected $m_priority = 'high';

    /**
     * {@inheritDoc}
     */
    public function panel() {
        global $post;
        $custom = get_post_custom($post->ID);
        //メタキーがあったら
        if(!empty($custom)) {
            $event_start = $custom["event_start"][0];
            $event_end = $custom["event_end"][0];
            //日付だけ表示
            $event_date = date("Y-m-d", strtotime($event_start));
            //開始時間
            $start_time =  date("H:i", strtotime($event_start));
            //終了時間
            $end_time =  date("H:i", strtotime($event_end));
        }
        echo '<input type="hidden" name="events-nonce" id="events-nonce" value="' . wp_create_nonce( 'events-nonce' ) . '" />';
        
        //入力フィールドの表示
        ?>
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
                <td><input name="event_date" class="event_date" id="datepicker" value="<?php if(isset ( $event_date)) echo $event_date; ?>" /></td>
            </tr>
            <tr>
                <th>時間</th>
                <td>
                    <input name="start_time" class="start_time" value="<?php if(isset ( $start_time)) echo $start_time; ?>" /> ～
                    <input name="end_time" class="end_time" value="<?php if(isset ( $end_time)) echo $end_time; ?>" />
                </td>
            </tr>
        </table>
        </div>
    <?php

    }

    /**
     * {@inheritDoc}
     */
    public function save($post_id){
        global $post;
        if (!isset($_POST['events-nonce'])) return $post_id;
        if ( !wp_verify_nonce($_POST['events-nonce'], 'events-nonce' )) {
            return $post_id;
        }
        if ( !current_user_can( 'edit_post', $post->ID )) {
            return $post_id;
        }
        $temp_date = $_POST['event_date'];
        $temp_stime = $_POST['start_time'];
        $temp_etime = $_POST['end_time'];
        $event_start = date('Y-m-d H:i:s', strtotime($temp_date .' '. $temp_stime));
        $event_end = date('Y-m-d H:i:s', strtotime($temp_date .' '. $temp_etime));
        
        update_post_meta($post->ID, 'event_start', $event_start);
        update_post_meta($post->ID, 'event_end', $event_end);
    }

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'イベントに関するフィールドを追加します。';
    }
}
function manage_events_columns($columns) {
	global $post_type;
	if( 'events' == $post_type ) {
		$columns['event_date'] = 'イベント日付';
		$columns['event_time'] = 'イベント時間';
		$columns['ecategory'] = 'カテゴリー';
	}
	return $columns;
}
function add_column($column_name, $post_id) {
	//日付表示
	if( $column_name == 'event_date' ) {
		echo date('Y年m月d日', strtotime(get_post_meta($post_id, 'event_start', true)));
	}
	//時間表示
	if( $column_name == 'event_time' ) {
		//開始時間
		$start_time =  date('H:i', strtotime(get_post_meta($post_id, 'event_start', true)));
		//終了時間
		$end_time =  date('H:i', strtotime(get_post_meta($post_id, 'event_end', true)));
		echo $start_time . '～' . $end_time;
	}
	//カテゴリー表示
	if( $column_name == 'ecategory' ) {
		$terms = get_the_terms($post_id, 'events');
		if ($terms !== false) {
    		foreach ($terms as $key => $value) {
    			echo attribute_escape($value->name);
    			//最後以外は「,」を
    			if (end(array_keys($terms)) != $key) {
    				echo ', ';
    			}
    		}
        }
	}
}
add_filter( 'manage_posts_columns', 'manage_events_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );