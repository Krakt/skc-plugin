<?php

include_once plugin_dir_path(__FILE__).'apanelgatewayswidget.php';

class Skc_Apanel_Gateways
{
    public function __construct()
    {
        add_action('widgets_init', function(){register_widget('Skc_Apanel_Gateways_Widget');});
        add_action('admin_menu', array($this, 'add_admin_menu'), 20);
        add_action('admin_init', array($this, 'register_settings'));
        
        add_shortcode('skc_apanel', array($this, 'apanel_gateways_html'));
    }
    
    public function apanel_gateways_html($atts, $content)
    {
//        global $wp_widget_factory;
//    
//        extract(shortcode_atts(array(
//            'widget_name' => FALSE
//        ), $atts));
//
//        $widget_name = wp_specialchars($widget_name);
//
//        if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
//            $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
//
//            if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
//                return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct"),'<strong>'.$class.'</strong>').'</p>';
//            else:
//                $class = $wp_class;
//            endif;
//        endif;
        
        $widget_name = wp_specialchars('Skc_Apanel_Gateways_Widget');

        ob_start();
        the_widget($widget_name, $instance, array('widget_id'=>'arbitrary-instance-'.$id,
            'before_widget' => '',
            'after_widget' => '',
            'before_title' => '',
            'after_title' => ''
        ));
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
    
    public function add_admin_menu()
    {
        add_submenu_page('skc', 'Apanel', 'Apanel', 'manage_options', 'skc_apanel_gateways', array($this, 'menu_html'));
    }
    
    public function menu_html()
    {
        echo '<h1>'.get_admin_page_title().'</h1>';
        ?>
        <form method="post" action="options.php">
            <?php settings_fields(('skc_apanel_gateways_settings')); ?>
            <?php do_settings_sections('skc_apanel_gateways_settings'); ?>
            <?php submit_button(); ?>
        </form>
        <?php
    }
    
    public function register_settings()
    {
        register_setting('skc_apanel_gateways_settings', 'skc_apanel_gateways_lbl_user');
        register_setting('skc_apanel_gateways_settings', 'skc_apanel_gateways_lbl_pass');
        register_setting('skc_apanel_gateways_settings', 'skc_apanel_gateways_lbl_btn_send');
        
        add_settings_section('skc_apanel_gateways_section', 'Param&egrave;tre des labels', array($this, 'section_html'), 'skc_apanel_gateways_settings');
        
        add_settings_field('skc_apanel_gateways_lbl_user', 'User Name', array($this, 'labeluser_html'), 'skc_apanel_gateways_settings', 'skc_apanel_gateways_section');
        add_settings_field('skc_apanel_gateways_lbl_pass', 'Password', array($this, 'labelpass_html'), 'skc_apanel_gateways_settings', 'skc_apanel_gateways_section');
        add_settings_field('skc_apanel_gateways_lbl_btn_send', 'Send button', array($this, 'labelbtnsend_html'), 'skc_apanel_gateways_settings', 'skc_apanel_gateways_section');
    }
    
    public function section_html()
    {
        echo 'Renseignez les param&egrave;tres des labels.';
        
    }
    
    public function labeluser_html()
    {?>
        <input type="text" name="skc_apanel_gateways_lbl_user" value="<?php echo get_option('skc_apanel_gateways_lbl_user'); ?>"/>
    <?php
    }
    
    public function labelpass_html()
    {?>
        <input type="text" name="skc_apanel_gateways_lbl_pass" value="<?php echo get_option('skc_apanel_gateways_lbl_pass'); ?>"/>
    <?php
    }
    
    public function labelbtnsend_html()
    {?>
        <input type="text" name="skc_apanel_gateways_lbl_btn_send" value="<?php echo get_option('skc_apanel_gateways_lbl_btn_send'); ?>"/>
    <?php
    }
}