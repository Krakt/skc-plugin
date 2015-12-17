<?php

class Skc_Menu_User_Name
{
    public function __construct()
    {
        add_shortcode('skc_menu_user_name', array($this, 'menuusername_html'));
        
    }
    
    public function menuusername_html($atts, $content)
    {
        $username = wp_get_current_user();
        return '<a href="'.$atts['href'].'" target="'.$atts['target'].'">'.$content. ' ' .$username->display_name.'</a>';
    }
}