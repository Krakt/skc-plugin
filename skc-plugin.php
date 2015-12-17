<?php
/*
Plugin Name: SK Computing Plugin
Plugin URI: http://skcomputing.ch
Description: Un plugin divers pour site perso
Version: 0.1
Author: Krakt
Author URI: http://sten.com
License: GPL2
*/

class Skc_Plugin
{
    public function __construct()
    {
        include_once plugin_dir_path(__FILE__).'menuusername.php';
        include_once plugin_dir_path(__FILE__).'apanelgateways.php';
        
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        new Skc_Menu_User_Name();
        new Skc_Apanel_Gateways();
    }
    
    public function add_admin_menu()
    {
        add_menu_page('Plugin SK Computing', 'Skc Plugin', 'manage_options', 'skc', array($this, 'menu_html'));
    }
    
    public function menu_html()
    {
        echo '<h1>'.get_admin_page_title().'<h1>';
        echo '<p>Bienvenue sur la page d\'acceuil du plugin</p>';
    }
}

new Skc_Plugin();