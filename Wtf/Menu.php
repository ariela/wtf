<?php
abstract class Wtf_Menu implements Wtf_IModule
{
    protected $m_id;
    protected $m_title;

    public function register()
    {
        register_nav_menus(array($this->m_id => $this->m_title));
    }
}
