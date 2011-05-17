<?php
class Wtf_Type_Books extends Wtf_Type
{
    protected $m_type = 'books';
    protected $m_labels = array(
        'name' => '本',
        'singular_name' => '本',
    );
    protected $m_public = true;
    protected $m_menu_position = 5;
    protected $m_supports = array(
        'title'
        , 'editor'
        , 'thumbnail'
        , 'custom-fields'
        , 'excerpt'
        , 'author'
        , 'trackbacks'
        , 'comments'
        , 'revisions'
        , 'page-attributes'
    );
}