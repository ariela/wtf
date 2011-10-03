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
     * フィールド等に使用されるキープレフィックス
     * @var string
     */
    protected $m_key = 'wtf_field_event';

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

    public function __construct()
    {
        add_filter( 'manage_posts_columns', array($this, 'manage_events_columns'));
        add_action( 'manage_posts_custom_column', array($this, 'add_column'), 10, 2);
    }

    /**
     * {@inheritDoc}
     */
    public function displayPanel() {
        require_once dirname(dirname(__FILE__)) . '/panel/field-event.php';
    }

    /**
     * {@inheritDoc}
     */
    public function save($post_id){
        global $post;
        if (!isset($_POST[$this->m_key . '_nonce'])) return $post_id;
        if ( !wp_verify_nonce($_POST[$this->m_key . '_nonce'], $this->m_key . '_nonce')) {
            return $post_id;
        }
        if ( !current_user_can('edit_post', $post->ID )) {
            return $post_id;
        }
        $temp_date = $_POST[$this->m_key . '_date'];
        $temp_stime = $_POST[$this->m_key . '_start_time'];
        $temp_etime = $_POST[$this->m_key . '_end_time'];
        $event_start = date('Y-m-d H:i:s', strtotime($temp_date .' '. $temp_stime));
        $event_end = date('Y-m-d H:i:s', strtotime($temp_date .' '. $temp_etime));
        
        update_post_meta($post->ID, $this->m_key . '_start', $event_start);
        update_post_meta($post->ID, $this->m_key . '_end', $event_end);
    }

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'イベントに関するフィールドを追加します。';
    }
    
    public function manage_events_columns($columns) {
        global $post_type;
        if( 'events' == $post_type ) {
            $columns[$this->m_key . '_date'] = 'イベント日付';
            $columns[$this->m_key . '_time'] = 'イベント時間';
            $columns[$this->m_key . '_category'] = 'カテゴリー';
        }
        return $columns;
    }
    
    public function add_column($column_name, $post_id) {
        //日付表示
        if( $column_name == $this->m_key . '_date' ) {
            echo date('Y年m月d日', strtotime(get_post_meta($post_id, $this->m_key . '_start', true)));
        }
        //時間表示
        if( $column_name == $this->m_key . '_time' ) {
            //開始時間
            $start_time =  date('H:i', strtotime(get_post_meta($post_id, $this->m_key . '_start', true)));
            //終了時間
            $end_time =  date('H:i', strtotime(get_post_meta($post_id, $this->m_key . '_end', true)));
            echo $start_time . '～' . $end_time;
        }
        //カテゴリー表示
        if( $column_name == $this->m_key . '_category' ) {
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
}
