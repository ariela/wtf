<?php
abstract class Wtf_Filter implements Wtf_IModule
{
    protected $m_tag;
    protected $m_callback;
    protected $m_priority = 10;
    protected $m_accepted_args = 1;

    public function register()
    {
        add_filter($this->m_tag, $this->m_callback, $this->m_priority, $this->m_accepted_args);
    }
}
