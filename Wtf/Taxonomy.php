<?php
abstract class Wtf_Taxonomy implements Wtf_IModule
{
    protected $m_id;
    protected $m_type;
    protected $m_label;
    protected $m_public;
    protected $m_show_ui;
    protected $m_show_tagcloud;
    protected $m_hierarchical;
    protected $m_update_count_callback;
    protected $m_rewrite;
    protected $m_query_var;
    protected $m_capabilities;

    public function register()
    {
        $options = array();

        if (!is_null($this->m_label)) {
            $options['label'] = $this->m_label;
        }
        if (!is_null($this->m_public)) {
            $options['public'] = $this->m_public;
        }
        if (!is_null($this->m_show_ui)) {
            $options['show_ui'] = $this->m_show_ui;
        }
        if (!is_null($this->m_show_tagcloud)) {
            $options['show_tagcloud'] = $this->m_show_tagcloud;
        }
        if (!is_null($this->m_hierarchical)) {
            $options['hierarchical'] = $this->m_hierarchical;
        }
        if (!is_null($this->m_update_count_callback)) {
            $options['update_count_callback'] = $this->m_update_count_callback;
        }
        if (!is_null($this->m_rewrite)) {
            $options['rewrite'] = $this->m_rewrite;
        }
        if (!is_null($this->m_query_var)) {
            $options['query_var'] = $this->m_query_var;
        }
        if (!is_null($this->m_capabilities)) {
            $options['capabilities'] = $this->m_capabilities;
        }

        register_taxonomy($this->m_id, $this->m_type, $options);
    }
}