<?php
/**
 * Google AdSenceを貼り付けるウィジェットモジュール
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
class Wtf_Widget_AdSence extends Wtf_Widget
{
    /**
     * {@inheritDoc}
     */
    protected $m_name = 'AdSence';
    
    /**
     * {@inheritDoc}
     */
    protected $m_widget_options = array(
        'description' => 'Google AdSenceを表示するウィジェット',
    );

    /** @see WP_Widget::widget */
    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $client = esc_attr($instance['client']);
        $slot   = esc_attr($instance['slot']);
        $width  = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);

        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }

        echo '<script type="text/javascript"><!--'."\n";
        printf('google_ad_client = "%s";'."\n", $client);
        printf('google_ad_slot = "%s";'."\n", $slot);
        printf('google_ad_width = %d;'."\n", $width);
        printf('google_ad_height = %d;'."\n", $height);
        echo '//--></script>'."\n";
        echo '<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>'."\n";

        $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance)
    {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance)
    {
        $title  = esc_attr($instance['title']);
        $client = esc_attr($instance['client']);
        $slot   = esc_attr($instance['slot']);
        $width  = esc_attr($instance['width']);
        $height = esc_attr($instance['height']);
        
        $fm = '<p><label for="%s">%s <input id="%s" class="widefat" name="%s" type="text" value="%s"></label></p>';

        $fid = $this->get_field_id('title');
        $fnm = $this->get_field_name('title');
        printf($fm, $fid, 'タイトル', $fid, $fnm, $title);

        $fid = $this->get_field_id('client');
        $fnm = $this->get_field_name('client');
        printf($fm, $fid, '運営者ID(ua-pub-*)', $fid, $fnm, $client);

        $fid = $this->get_field_id('slot');
        $fnm = $this->get_field_name('slot');
        printf($fm, $fid, 'スロットID', $fid, $fnm, $slot);
        
        $fid = $this->get_field_id('width');
        $fnm = $this->get_field_name('width');
        printf($fm, $fid, '幅', $fid, $fnm, $width);
        
        $fid = $this->get_field_id('height');
        $fnm = $this->get_field_name('height');
        printf($fm, $fid, '高さ', $fid, $fnm, $height);
        
    }

    /**
     * {@inheritDoc}
     */
    public static function description()
    {
        return 'Google AdSenceのタグを貼り付けるウィジェットです。';
    }
}