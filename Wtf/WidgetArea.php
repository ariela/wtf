<?php
abstract class Wtf_WidgetArea implements Wtf_IModule
{
    protected $m_id;
    protected $m_name;
    protected $m_description;
    protected $m_widget_before = '<section id="%1$s" class="widget %2$s">';
    protected $m_widget_after = '</section>';
    protected $m_title_before = '<header><h1>';
    protected $m_title_after = '</h1></header>';

    /**
     * ウィジェットを登録する関数
     */
    public function register()
    {
        $widget = array(
            'id' => $this->m_id,
            'name' => $this->m_name,
            'description' => $this->m_description,
            'before_widget' => $this->m_widget_before,
            'after_widget' => $this->m_widget_after,
            'before_title' => $this->m_title_before,
            'after_title' => $this->m_title_after,
        );
        register_sidebar($widget);
    }
}