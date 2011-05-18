<?php
class Wtf_Taxonomy_Books extends Wtf_Taxonomy
{
    protected $m_id = 'books';
    protected $m_type = array('post', 'books');
    protected $m_hierarchical = true;
    protected $m_update_count_callback = '_update_post_term_count';
    protected $m_label = '本のカテゴリ';
    protected $m_singular_label = '本のカテゴリ';
    protected $m_public = true;
    protected $m_show_ui = true;

    public static function description()
    {
        return '本に関するカスタムタクソノミーを追加します。';
    }
}
