<?php
abstract class Wtf_Type implements Wtf_IModule
{
    protected $m_type;
    protected $m_label;
    protected $m_labels;
    protected $m_description;
    protected $m_public;
    protected $m_publicly_queryable;
    protected $m_exclude_from_search;
    protected $m_show_ui;
    protected $m_capability_type;
    protected $m_capabilities;
    protected $m_hierarchical;
    protected $m_supports;
    protected $m_register_meta_box_cb;
    protected $m_taxonomies;
    protected $m_menu_position;
    protected $m_menu_icon;
    protected $m_permalink_epmask;
    protected $m_rewrite;
    protected $m_query_var;
    protected $m_can_export;
    protected $m_show_in_nav_menus;

    public function register()
    {
        $options = array();
        if (!is_null($this->m_label)) {
            $options['label'] = $this->m_label;
        }
        if (!is_null($this->m_labels)) {
            $options['labels'] = $this->m_labels;
        }
        if (!is_null($this->m_description)) {
            $options['description'] = $this->m_description;
        }
        if (!is_null($this->m_public)) {
            $options['public'] = $this->m_public;
        }
        if (!is_null($this->m_publicly_queryable)) {
            $options['publicly_queryable'] = $this->m_publicly_queryable;
        }
        if (!is_null($this->m_exclude_from_search)) {
            $options['exclude_from_search'] = $this->m_exclude_from_search;
        }
        if (!is_null($this->m_show_ui)) {
            $options['show_ui'] = $this->m_show_ui;
        }
        if (!is_null($this->m_capability_type)) {
            $options['capability_type'] = $this->m_capability_type;
        }
        if (!is_null($this->m_capabilities)) {
            $options['capabilities'] = $this->m_capabilities;
        }
        if (!is_null($this->m_hierarchical)) {
            $options['hierarchical'] = $this->m_hierarchical;
        }
        if (!is_null($this->m_supports)) {
            $options['supports'] = $this->m_supports;
        }
        if (!is_null($this->m_register_meta_box_cb)) {
            $options['register_meta_box_cb'] = $this->m_register_meta_box_cb;
        }
        if (!is_null($this->m_taxonomies)) {
            $options['taxonomies'] = $this->m_taxonomies;
        }
        if (!is_null($this->m_menu_position)) {
            $options['menu_position'] = $this->m_menu_position;
        }
        if (!is_null($this->m_menu_icon)) {
            $options['menu_icon'] = $this->m_menu_icon;
        }
        if (!is_null($this->m_permalink_epmask)) {
            $options['permalink_epmask'] = $this->m_permalink_epmask;
        }
        if (!is_null($this->m_rewrite)) {
            $options['rewrite'] = $this->m_rewrite;
        }
        if (!is_null($this->m_query_var)) {
            $options['query_var'] = $this->m_query_var;
        }
        if (!is_null($this->m_can_export)) {
            $options['can_export'] = $this->m_can_export;
        }
        if (!is_null($this->m_show_in_nav_menus)) {
            $options['show_in_nav_menus'] = $this->m_show_in_nav_menus;
        }

        register_post_type($this->m_type, $options);
    }
}