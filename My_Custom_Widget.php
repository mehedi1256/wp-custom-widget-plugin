<?php

class My_Custom_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'my_custom_widget',
            'My Custom Widget',
            array(
                'description' => 'Display Recent Posts and a Static Message'
            )
        );
    }

    // display widget to admin panel
    public function form( $instance ) {
        ?>
        <p>
            <label for="<?= $this->get_field_name('mcw_title')?>">Title</label>
            <input type="text" name="<?= $this->get_field_name('mcw_title')?>" id="<?= $this->get_field_id('mcw_title') ?>" class="widefat" value="">
        </p>

        <p>
            <label for="<?= $this->get_field_name('mcw_display_option')?>">Display Type</label>
            <select class="widefat" name="<?= $this->get_field_name('mcw_display_option')?>" id="<?= $this->get_field_id('mcw_display_option')?>">
                <option value="">Recent Post</option>
                <option value="">Static Message</option>
            </select>
        </p>

        <p id="mcw_display_recent_posts">
            <label for="<?= $this->get_field_name('mcw_number_of_posts')?>">Number of posts</label>
            <input type="number" name="<?= $this->get_field_name('mcw_number_of_posts')?>" id="<?= $this->get_field_id('mcw_number_of_posts')?>" value="" class="widefat">
        </p>

        <p id="mcw_display_static_message">
            <label for="<?= $this->get_field_name('mcw_your_message')?>">Your Message</label>
            <input type="text" name="<?= $this->get_field_name('mcw_your_message')?>" id="<?= $this->get_field_id('mcw_your_message')?>" value="" class="widefat">
        </p>
        <?php
    }

    // save widget settings to wordpress
    public function update( $new_instance, $old_instance ) {
		
	}

    // display widget to frontend
    public function widget( $args, $instance ) {
		
	}
}