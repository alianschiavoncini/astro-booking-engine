<?php
/**
 * Astro Booking Engine Widget Class.
 *
 * @class   Astro_BE_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!class_exists('Astro_BE_Widget')) {

    class Astro_BE_Widget extends WP_Widget {

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
            // before and after widget arguments are HTML defined by themes: esc_html() would print
            // the markup as visible text, wp_kses_post() keeps it and removes scripts
            echo wp_kses_post( $args['before_widget'] );

            $title = isset( $instance['title'] ) ? $instance['title'] : '';
            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            if (!empty($title)) {
                echo wp_kses_post( $args['before_title'] ) . esc_html( $title ) . wp_kses_post( $args['after_title'] );
            }

            echo do_shortcode('[astro-booking-engine]');

            // This is where you run the code and display the output
            echo wp_kses_post( $args['after_widget'] );

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
		register_widget( 'Astro_BE_Widget' );
	}
	add_action( 'widgets_init', 'astro_be_registration' );

	// The block-based widget editor already offers the Astro Booking Engine block: hide the
	// classic widget from its inserter, as WordPress does for its own widgets replaced by blocks.
	// Widgets already added keep working, and the classic widget screen is not affected.
	function astro_be_hide_legacy_widget( $widget_types ) {
		$widget_types[] = 'astro_be';
		return $widget_types;
	}
	add_filter( 'widget_types_to_hide_from_legacy_widget_block', 'astro_be_hide_legacy_widget' );

}

