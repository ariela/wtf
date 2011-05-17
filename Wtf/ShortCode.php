<?php
abstract class Wtf_ShortCode implements Wtf_IModule
{
    protected $m_id;
    protected $m_callback;

    public function register()
    {
        add_shortcode($this->m_id, $this->m_callback);
    }
}