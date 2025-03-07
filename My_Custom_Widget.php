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
            <label for="">Title</label>
        </p>
        <?php
    }
}