<?php
/**
 * AstroThemes Booking Engine Widget Class.
 *
 * @class   AstroThemes_BE_Widget
 */

if (!class_exists('AstroThemes_BE_Widget')) {

    class AstroThemes_BE_Widget extends WP_Widget {

        // The construct part
        function __construct() {
            parent::__construct(

                // Base ID of your widget
                'astro_be',

                // Widget name will appear in UI
                __( 'Astro Booking Engine', 'astro-booking-engine' ),

                // Widget description
                array( 'description' => __( 'The Astro Booking Engine plugin displays a user friendly and responsive booking engine form.', 'astro-booking-engine' ), )
            );
        }

        // Creating widget front-end
        public function widget( $args, $instance ) {
            // before and after widget arguments are defined by themes
            echo esc_html( $args['before_widget'] );

            $title = apply_filters( 'widget_title', $instance['title'] );
            if (!empty($title)) {
                echo esc_html( $args['before_title'] . $title . $args['after_title'] );
            }

            echo do_shortcode('[astro-booking-engine]');

            // This is where you run the code and display the output
            echo esc_html( $args['after_widget'] );

           return $instance;
        }

        // Creating widget Backend
        public function form( $instance ) {
            if ( isset( $instance[ 'title' ] ) ) {
                $title = $instance[ 'title' ];
            }else{
                $title = __( 'New title', 'astro-booking-engine' );
            }
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'astro-booking-engine' ); ?>:</label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
        }

        // Updating widget replacing old instances with new
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
            return $instance;
        }

	}

    // Register and load the widget class
	function astro_be_registration() {
		register_widget( 'AstroThemes_BE_Widget' );
	}
	add_action( 'widgets_init', 'astro_be_registration' );

}

