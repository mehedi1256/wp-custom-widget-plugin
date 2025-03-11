<?php

class My_Custom_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'my_custom_widget',
            'My Custom Widget',
            array(
                'description' => 'Display Recent Posts and a Static Message'
            )
        );
    }

    // display widget to admin panel
    public function form($instance)
    {
        // Define defaults and sanitize values
        $defaults = [
            'mcw_title' => '',
            'mcw_display_option' => '',
            'mcw_number_of_posts' => '',
            'mcw_your_message' => ''
        ];

        $instance = wp_parse_args((array) $instance, $defaults);

        // Extract values for cleaner access
        $title = esc_attr($instance['mcw_title']);
        $display_option = esc_attr($instance['mcw_display_option']);
        $number_of_posts = esc_attr($instance['mcw_number_of_posts']);
        $static_message = esc_attr($instance['mcw_your_message']);
?>

        <p>
            <label for="<?= esc_attr($this->get_field_id('mcw_title')) ?>">Title</label>
            <input
                type="text"
                name="<?= esc_attr($this->get_field_name('mcw_title')) ?>"
                id="<?= esc_attr($this->get_field_id('mcw_title')) ?>"
                class="widefat"
                value="<?= $title ?>">
        </p>

        <p>
            <label for="<?= esc_attr($this->get_field_id('mcw_display_option')) ?>">Display Type</label>
            <select
                class="widefat mcw_dd_options"
                name="<?= esc_attr($this->get_field_name('mcw_display_option')) ?>"
                id="<?= esc_attr($this->get_field_id('mcw_display_option')) ?>">
                <?php
                $display_options = [
                    'recent_posts' => 'Recent Post',
                    'static_message' => 'Static Message'
                ];

                foreach ($display_options as $value => $label) {
                    printf(
                        '<option value="%s" %s>%s</option>',
                        esc_attr($value),
                        selected($display_option, $value, false),
                        esc_html($label)
                    );
                }
                ?>
            </select>
        </p>

        <p
            id="mcw_display_recent_posts"
            class="<?= $display_option === 'recent_posts' ? '' : 'hide_element' ?>">
            <label for="<?= esc_attr($this->get_field_id('mcw_number_of_posts')) ?>">Number of posts</label>
            <input
                type="number"
                name="<?= esc_attr($this->get_field_name('mcw_number_of_posts')) ?>"
                id="<?= esc_attr($this->get_field_id('mcw_number_of_posts')) ?>"
                value="<?= $number_of_posts ?>"
                class="widefat">
        </p>

        <p
            id="mcw_display_static_message"
            class="<?= $display_option === 'static_message' ? '' : 'hide_element' ?>">
            <label for="<?= esc_attr($this->get_field_id('mcw_your_message')) ?>">Your Message</label>
            <input
                type="text"
                name="<?= esc_attr($this->get_field_name('mcw_your_message')) ?>"
                id="<?= esc_attr($this->get_field_id('mcw_your_message')) ?>"
                value="<?= $static_message ?>"
                class="widefat">
        </p>

<?php
    }

    // save widget settings to wordpress
    public function update($new_instance, $old_instance)
    {
        $instance = []; // mcw_title,mcw_display_option,mcw_number_of_posts,mcw_your_message
        $instance['mcw_title'] = !empty($new_instance['mcw_title']) ? strip_tags($new_instance['mcw_title']) : "";
        $instance['mcw_display_option'] = !empty($new_instance['mcw_display_option']) ? sanitize_text_field($new_instance['mcw_display_option']) : "";
        $instance['mcw_number_of_posts'] = !empty($new_instance['mcw_number_of_posts']) ? sanitize_text_field($new_instance['mcw_number_of_posts']) : "";
        $instance['mcw_your_message'] = !empty($new_instance['mcw_your_message']) ? sanitize_text_field($new_instance['mcw_your_message']) : "";
        return $instance;
    }

    // display widget to frontend
    public function widget($args, $instance)
    {
        $title = apply_filters("widget_title", $instance['mcw_title']);
        echo $args['before_widget'];
        echo $args['before_title'];
        echo $title;
        echo $args['after_title'];

        // check for display type
        if ($instance['mcw_display_option'] === 'static_message') {
            echo $instance['mcw_your_message'];
        } elseif ($instance['mcw_display_option'] === 'recent_posts') {
            $query = new WP_Query(array(
                'posts_per_page' => $instance['mcw_number_of_posts'],
                'post_status' => 'publish'
            ));

            if ($query->have_posts()) {
                echo '<ul>';
                while ($query->have_posts()) {
                    $query->the_post();
                    echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            } else {
                echo 'No posts found';
            }
        }
        echo $args['after_widget'];
    }
}
