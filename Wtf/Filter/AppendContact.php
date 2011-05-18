<?php
class Wtf_Filter_AppendContact extends Wtf_Filter
{
    protected $m_tag = 'user_contactmethods';
    protected $m_priority = 10;
    protected $m_accepted_args = 1;

    public function __construct()
    {
        $this->m_callback = array($this, 'callback');
    }

    public function callback($contact)
    {
        $contact['twitter'] = 'Twitter';
        $contact['facebook'] = 'Facebook';
        return $contact;
    }

    public static function description()
    {
        return 'プロフィールに項目を追加します。';
    }
}