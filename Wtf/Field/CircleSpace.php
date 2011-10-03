<?php
/**
 * フィールドにサークルスペースの項目を追加するカスタムフィールドモジュール
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
class Wtf_Field_CircleSpace extends Wtf_Field
{
    /**
     * フィールド等に使用されるキープレフィックス
     * @var string
     */
    protected $m_key = 'wtf_field_circlespace';

    /**
     * {@inheritDoc}
     */
    protected $m_id = 'circlespace';
    /**
     * {@inheritDoc}
     */
    protected $m_title = 'サークルスペース';
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
        require_once dirname(dirname(__FILE__)) . '/panel/field-circlespace.php';
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
        $name = $_POST[$this->m_key . '_name'];
        $space = $_POST[$this->m_key . '_space'];
        
        update_post_meta($post->ID, $this->m_key . '_name', $name);
        update_post_meta($post->ID, $this->m_key . '_space', $space);
    }

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'サークルスペースに関するフィールドを追加します。';
    }
    
    public function manage_events_columns($columns) {
        global $post_type;
        if( 'events' == $post_type ) {
            $columns[$this->m_key . '_name'] = 'サークル名';
            $columns[$this->m_key . '_space'] = 'スペース';
        }
        return $columns;
    }
    
    public function add_column($column_name, $post_id) {
        if( $column_name == $this->m_key . '_name' ) {
            echo get_post_meta($post_id, $this->m_key . '_name', true);
        }
        if( $column_name == $this->m_key . '_space' ) {
            echo get_post_meta($post_id, $this->m_key . '_space', true);
        }
    }
}
