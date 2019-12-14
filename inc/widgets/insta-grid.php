<?php
/**
 * An Instgram Widget
 */

class instagram_grid_widget extends WP_Widget
{

    public $max_images = 4;
    public $image_url_prefix = 'image';
    public $button_title = 'button_title';

    function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'scripts'));

        $widget_ops = array(
            'classname' => '',
            'description' => __('Just a widget to display 4 images', 'loremipsum'),
            'customize_selective_refresh' => true,
        );
        $control_ops = array('width' => 200, 'height' => 250);
        parent::__construct(false, $name = __('LOREMIPSUM Instagram Grid 4 Images', 'loremipsum'), $widget_ops);
    }

    function scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_media();
        wp_enqueue_script('loremipsum-impage_upload', get_template_directory_uri() . '/js/image_upload.js', array('jquery'));
    }

    function form($instance)
    {
        $instance = wp_parse_args(( array )$instance, array(
            'title' => '',
            $this->button_title => '',
            'instagram_url' => '',
            $this->image_url_prefix . '_1' => '',
            $this->image_url_prefix . '_2' => '',
            $this->image_url_prefix . '_3' => '',
            $this->image_url_prefix . '_4' => ''
        ));
        $title = esc_attr($instance['title']);
        $instagram_url = esc_attr($instance['instagram_url']);

        for ($i = 1; $i <= $this->max_images; $i++) {
            $image_url = $this->image_url_prefix . '_' . $i;
            $instance[$image_url] = esc_url($instance[$image_url]);
        }
        ?>

        <!-- set title?! -->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'Title'); ?></label>
            <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
                   type="text" value="<?php echo $title; ?>"/>
        </p>

        <!-- set title?! -->
        <p>
            <label for="<?php echo $this->get_field_id($this->button_title); ?>"><?php _e('Button Title:', 'Button Title'); ?></label>
            <input id="<?php echo $this->get_field_id($this->button_title); ?>"
                   name="<?php echo $this->get_field_name($this->button_title); ?>"
                   type="text" value="<?php echo $title; ?>"/>
        </p>

        <!-- set Instagram url -->
        <p>
            <label for="<?php echo $this->get_field_id('instagram_url'); ?>"><?php _e('Instagram Url:', 'Instagram Url'); ?></label>
            <input id="<?php echo $this->get_field_id('instagram_url'); ?>"
                   name="<?php echo $this->get_field_name('instagram_url'); ?>"
                   type="text" value="<?php echo $instagram_url; ?>"/>
        </p>

        <!-- set all images -->
        <?php
        for ($i = 1; $i <= $this->max_images; $i++) {
            $image_url = 'image_' . $i;
            ?>

            <p>
                <label for="<?php echo $this->get_field_id($image_url); ?>"> <?php _e('Image ', 'loremipsum');
                    echo $i; ?></label>
            <div class="media-uploader" id="<?php echo $this->get_field_id($image_url); ?>">
                <div class="custom_media_preview">
                    <?php if ($instance[$image_url] != '') : ?>
                        <img class="custom_media_preview_default img-<?php echo $image_url?>" src="<?php echo esc_url($instance[$image_url]); ?>"
                             style="max-width:100%;"/>
                    <?php endif; ?>
                </div>
                <input type="text"
                       class="widefat custom_media_input"
                       id="<?php echo $this->get_field_id($image_url); ?>"
                       name="<?php echo $this->get_field_name($image_url); ?>"
                       value="<?php echo esc_url($instance[$image_url]); ?>"/>

                <button class="upload_image_button" name="<?php echo $image_url?>">Select Image</button>
            </div>
            </p>
        <?php } ?>

        <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['instagram_url'] = strip_tags($new_instance['instagram_url']);
        $instance[$this->button_title] = strip_tags($new_instance[$this->button_title]);

        for ($i = 1; $i <= $this->max_images; $i++) {
            $image_url = $this->image_url_prefix . '_' . $i;
            $instance[$image_url] = (!empty($new_instance[$image_url])) ? $new_instance[$image_url] : '';
        }
        return $instance;
    }

    function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        $title = isset($instance['title']) ? $instance['title'] : '';
        $instagram_url = isset($instance['instagram_url']) ? $instance['instagram_url'] : '';
        $button_title = isset($instance[$this->button_title]) ? $instance[$this->button_title] : '';
        $image_array = array();


        for ($i = 1; $i <= $this->max_images; $i++) {
            $image_url = $this->image_url_prefix . '_' . $i;
            $image_url = isset($instance[$image_url]) ? $instance[$image_url] : '';

            if (!empty($image_url)) {
                array_push($image_array, $image_url);
            }
        }


        echo $before_widget;
        ?>

        <div class="instagram-grid">
            <div class="instagram-head">
                <h2><?php echo $title; ?></h2>
                    <a class="follow" href="<?php echo $instagram_url; ?>" target="_blank">
                        <?php echo esc_html($button_title); ?>
                    </a>
            </div>

            <a href="<?php echo $instagram_url; ?>" target="_blank">
                <?php
                $output = '';
                if (!empty($image_array)) {
                    $image_id = attachment_url_to_postid($image_url);
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                    $output .= '<div class="instagram-items">';
                    for ($i = 1; $i <= $this->max_images; $i++) {
                        $j = $i - 1;
                        if (!empty($image_array[$j])) {
                            $output .= '<img src="' . $image_array[$j] . '" alt="' . $image_alt . '">';
                        }
                    }
                    $output .= '</div>';
                    echo $output;
                }
                ?>
            </a>
        </div>
        <?php
        echo $after_widget;
    }
}
