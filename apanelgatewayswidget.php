<?php

class Skc_Apanel_Gateways_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('skc_apanel_gateways',
                            'SK Computing - Apanel Gateways',
                            array('description' => 'Un widget permettant de se connecter au Apanel de swisscenter!'));
    }
    
    public function form($instance)
    {
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_name('title')?>">
                <?php _e('Title:'); ?>
            </label>
            <input class="widefat"
                   id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>"
                   type="text"
                   value="<?php echo $title; ?>"/>
        </p>
        <?php
    }
    
    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        echo $args['before_title'];
        echo apply_filters('widget_title', $instance['title']);
        echo $args['after_title'];
        ?>
            <form action="https://apanel.swisscenter.com/login" method="post">
                <div>
                    <div>
                        <div>
                            <label for="login_username"><?php echo get_option('skc_apanel_gateways_lbl_user'); ?> <span class="required">*</span></label>
                        </div>
                        <div>
                            <input type="text" name="login[username]" class="text" id="login_username" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="login_password"><?php echo get_option('skc_apanel_gateways_lbl_pass'); ?> <span class="required">*</span></label>
                        </div>
                        <div>
                            <input type="password" name="login[password]" class="text" id="login_password" />
                        </div>
                    </div>
                    <div>
                        <button onFocus="this.blur();" type="submit"><?php echo get_option('skc_apanel_gateways_lbl_btn_send'); ?></button>
                    </div>
                </div>
            </form>
        <?php
        echo $args['after_widget'];
    }
}