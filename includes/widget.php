<?php

include_once dirname(__FILE__)  . '/krumo/class.krumo.php';
include_once dirname(__FILE__)  . '/includes/widget.php';
krumo::$skin = 'orange';

class Keywords_Widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'keywords_widget',
            'description' => 'Keywords Search',
        );
        parent::__construct( 'keywords_widget', 'Keywords Search', $widget_ops );
    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
            $data = get_web_service($_COOKIE['google_optimize_token']);
            $storage = json_decode($data);
            $keyword = $storage->content->category;
        ?>
        <aside id='mpw_widget' class='widget mpw_widget'>
            <h3 class='widget-title'>Widget Custom</h3>
            <p>Ultima intencion de busqueda : @Keywork</p>
        </aside>
        <?php
        echo $keyword;
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }
}

?>