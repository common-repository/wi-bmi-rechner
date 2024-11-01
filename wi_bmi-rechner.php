<?php
/*
Plugin Name: BMI-Rechner/BMI-Calculator
Plugin URI: http://body-mass-index.org/wordpress-bmi-rechner/
Description: Umfangreiches BMI Rechner Widget / Extensive BMI Calculator Widget
Version: 1.2.7
Author: Body-Mass-Index.org
Author URI: http://body-mass-index.org
License: GPLv2 or later
*/

class wi_bmi_rechner_widget extends WP_Widget {

	public function __construct() {
		load_plugin_textdomain('wi_bmi-rechner', false,dirname(plugin_basename( __FILE__ ) ) ); 
		parent::__construct(
	 		'w-i_bmi-rechner',
			__( 'BMI-Rechner', 'wi_bmi-rechner' ),
			array( 'description' => __( 'Dein BMI-Rechner Widget', 'wi_bmi-rechner' ), )
		);
	}	 
	 
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$wi_geschlecht = apply_filters('geschlecht', $instance['geschlecht']);
		$wi_ampu_1 = apply_filters('ampu_1', $instance['ampu_1']);
		$wi_ampu_2 = apply_filters('ampu_2', $instance['ampu_2']);
		$wi_external_links = apply_filters('external_links', $instance['external_links']);
		$wi_plugin_url=plugins_url( '' , __FILE__ );
		
		$wi_text_al				= __( 'Ihr BMI-Wert', 'wi_bmi-rechner' );
		$wi_text_gender			= __( 'Geschlecht', 'wi_bmi-rechner' );
		$wi_text_height			= __( 'Gr&ouml;&szlig;e', 'wi_bmi-rechner' );
		$wi_text_weight			= __( 'Gewicht', 'wi_bmi-rechner' );
		$wi_text_bmi_button		= __( 'BMI berechnen', 'wi_bmi-rechner' );
		$wi_text_an				= __( 'Sie haben','wi_bmi-rechner' );
		$wi_text_untergewicht	= __( 'Untergewicht','wi_bmi-rechner' );
		$wi_text_normalgewicht	= __( 'Normalgewicht','wi_bmi-rechner' );
		$wi_text_uebergewicht	= __( '&Uuml;bergewicht ','wi_bmi-rechner' );
		$wi_text_adipositas 	= __( 'Adipositas','wi_bmi-rechner');
		$wi_text_str_adipositas = __( 'starke Adipositas','wi_bmi-rechner' );
		$wi_text_ampu1			= __( 'Amputation 1','wi_bmi-rechner' );
		$wi_text_ampu2			= __( 'Amputation 2','wi_bmi-rechner' );
		$wi_text_ampu_not		= __( 'Keine','wi_bmi-rechner' );
		$wi_text_ampu_hand		= __( 'Hand','wi_bmi-rechner' );
		$wi_text_ampu_forearm	= __( 'Unterarm/Hand','wi_bmi-rechner' );
		$wi_text_ampu_upper_arm = __( 'Ober-/Unterarm','wi_bmi-rechner' );
		$wi_text_ampu_foot		= __( 'Fu&szlig;','wi_bmi-rechner' );
		$wi_text_ampu_lower_leg = __( 'Unterschenkel/Fu&szlig;','wi_bmi-rechner' );
		$wi_text_ampu_thigh		= __( 'Ober-/Unterschenkel/Fu&szlig;','wi_bmi-rechner' );
		$wi_text_gender_m		= __( 'm&auml;nnlich' , 'wi_bmi-rechner' );
		$wi_text_gender_w		= __( 'weiblich' , 'wi_bmi-rechner' );
		$wi_text_alert_no		= __( 'Groesse und/oder Gewicht wurde nicht angegeben','wi_bmi-rechner' );
		$wi_button_back			= __( 'Zur&uuml;ck' , 'wi_bmi-rechner' );
		$wi_language			= __( 'de' , 'wi_bmi-rechner' );
		
		

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			$geschlecht="";
			if($wi_geschlecht) {
				eval ("\$geschlecht= \"".$this->template("gender")."\";");
				$wi_gender=1;
			}
			if($wi_ampu_1) {
				eval ("\$amputation.= \"".$this->template("amputation1")."\";");
				$wi_ampu1=1;
			}
			if($wi_ampu_2) {
				eval ("\$amputation.= \"".$this->template("amputation2")."\";");
				$wi_ampu2=1;
			}
			if($wi_external_links) {
				$wi_external_links=1;
				eval ("\$wi_link.= \"".$this->template("wi_link")."\";");
			}
			
			eval ("\$mainwidget= \"".$this->template("mainwidget")."\";");

		echo __($mainwidget, 'text_domain' );
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['geschlecht'] = $new_instance['geschlecht'];
		$instance['ampu_1'] = $new_instance['ampu_1'];
		$instance['ampu_2'] = $new_instance['ampu_2'];
		$instance['external_links'] = $new_instance['external_links'];
		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'BMI-Rechner', 'wi_bmi-rechner' );
		}
		
		$wi_bmi_o1= strip_tags($instance['bmi_o1']);
		$wi_ampu_1 = esc_attr($instance['wi_ampu_1']);
		$wi_ampu_2 = esc_attr($instance['wi_ampu_2']);
		$wi_geschlecht = esc_attr($instance['geschlecht']);
		$wi_external_links = esc_attr($instance['external_links']);
		$wi_warnhinweis			= __( 'Wenn Sie &quot;Externe Links&quot; aktivieren haben Ihre Besucher die M&ouml;glichkeit eine ausf&uuml;hrliche Erkl&auml;rung zur Gewichtseinstufung ihres BMIs inkl. m&ouml;glicher Ursachenbenennung und Methoden zum Errechen des Idealgewichts abzurufen.','wi_bmi-rechner' );
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'geschlecht' ); ?>"><?php _e( 'Geschlecht anzeigen','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['geschlecht'], true ); ?> id="<?php echo $this->get_field_id( 'geschlecht' ); ?>" name="<?php echo $this->get_field_name( 'geschlecht' ); ?>" />
					<br />
				</p> 
				<p>
					<label for="<?php echo $this->get_field_id( 'ampu_1' ); ?>"><?php _e( '1. Amputiertenfeld anzeigen','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['ampu_1'], true ); ?> id="<?php echo $this->get_field_id( 'ampu_1' ); ?>" name="<?php echo $this->get_field_name( 'ampu_1' ); ?>" />
					<br />
				</p> 
				<p>
					<label for="<?php echo $this->get_field_id( 'ampu_2' ); ?>"><?php _e('2. Amputiertenfeld anzeigen','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['ampu_2'], true ); ?> id="<?php echo $this->get_field_id( 'ampu_2' ); ?>" name="<?php echo $this->get_field_name( 'ampu_2' ); ?>" />
					<br />
				</p> 
				<p>
					<label for="<?php echo $this->get_field_id( 'external_links' ); ?>"><?php _e('Externe Links','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['external_links'], true ); ?> id="<?php echo $this->get_field_id( 'external_links' ); ?>" name="<?php echo $this->get_field_name( 'external_links' ); ?>" />
					<br />
				</p> 
				<p><i><?php
				echo $wi_warnhinweis ?></i>
				</p>
				
		<?php 
	}
	
	
	
	public function template( $name ) {
		$template	=	file(dirname(__FILE__) ."/templates/".$name.".html"); 
		$template	=	implode("",$template); 
		$template	=	str_replace("\"", "\\\"", $template); 
		return $template; 
	}


} 

// Kinder BMI Rechner


class wi_bmi_c_rechner_widget extends WP_Widget {

	public function __construct() {
		load_plugin_textdomain('wi_bmi-rechner', false,dirname(plugin_basename( __FILE__ ) ) ); 
		parent::__construct(
	 		'w-i_bmi-c-rechner',
			__( 'BMI-Rechner Kinder', 'wi_bmi-rechner' ),
			array( 'description' => __( 'Dein Kinder-BMI-Rechner Widget', 'wi_bmi-rechner' ), )
		);
	}	 
	 
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );
		$wi_ampu_1 = apply_filters('ampu_1', $instance['ampu_1']);
		$wi_ampu_2 = apply_filters('ampu_2', $instance['ampu_2']);
		$wi_external_links = apply_filters('external_links', $instance['external_links']);
		$wi_plugin_url=plugins_url( '' , __FILE__ );
		
		$wi_text_al				= __( 'Dein BMI-Wert', 'wi_bmi-rechner' );
		$wi_text_gender			= __( 'Geschlecht', 'wi_bmi-rechner' );
		$wi_text_height			= __( 'Gr&ouml;&szlig;e', 'wi_bmi-rechner' );
		$wi_text_weight			= __( 'Gewicht', 'wi_bmi-rechner' );
		$wi_text_bmi_button		= __( 'BMI berechnen', 'wi_bmi-rechner' );
		$wi_text_an				= __( 'Du hast','wi_bmi-rechner' );
		$wi_text_untergewicht	= __( 'Untergewicht','wi_bmi-rechner' );
		$wi_text_normalgewicht	= __( 'Normalgewicht','wi_bmi-rechner' );
		$wi_text_uebergewicht	= __( '&Uuml;bergewicht ','wi_bmi-rechner' );
		$wi_text_adipositas 	= __( 'Adipositas','wi_bmi-rechner');
		$wi_text_str_adipositas = __( 'starke Adipositas','wi_bmi-rechner' );
		$wi_text_ampu1			= __( 'Amputation 1','wi_bmi-rechner' );
		$wi_text_ampu2			= __( 'Amputation 2','wi_bmi-rechner' );
		$wi_text_ampu_not		= __( 'Keine','wi_bmi-rechner' );
		$wi_text_ampu_hand		= __( 'Hand','wi_bmi-rechner' );
		$wi_text_ampu_forearm	= __( 'Unterarm/Hand','wi_bmi-rechner' );
		$wi_text_ampu_upper_arm = __( 'Ober-/Unterarm','wi_bmi-rechner' );
		$wi_text_ampu_foot		= __( 'Fu&szlig;','wi_bmi-rechner' );
		$wi_text_ampu_lower_leg = __( 'Unterschenkel/Fu&szlig;','wi_bmi-rechner' );
		$wi_text_ampu_thigh		= __( 'Ober-/Unterschenkel/Fu&szlig;','wi_bmi-rechner' );
		$wi_text_alter 			= __( 'Alter','wi_bmi-rechner' );
		$wi_text_gender_m		= __( 'Junge' , 'wi_bmi-rechner' );
		$wi_text_gender_w		= __( 'M&auml;dchen' , 'wi_bmi-rechner' );
		$wi_text_alert_no		= __( 'Groesse und/oder Gewicht wurde nicht angegeben','wi_bmi-rechner' );
		$wi_button_back			= __( 'Zur&uuml;ck' , 'wi_bmi-rechner' );
		$wi_language			= __( 'de' , 'wi_bmi-rechner' );
		

		

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
			if($wi_ampu_1) {
				eval ("\$amputation.= \"".$this->template("amputation1_c")."\";");
				$wi_ampu1=1;
			}
			if($wi_ampu_2) {
				eval ("\$amputation.= \"".$this->template("amputation2_c")."\";");
				$wi_ampu2=1;
			}
			if($wi_external_links) {
				$wi_external_links=1;
				eval ("\$wi_link.= \"".$this->template("wi_link")."\";");
			}
			
			eval ("\$mainwidget= \"".$this->template("mainwidget_c")."\";");

		echo __($mainwidget, 'text_domain' );
		echo $after_widget;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['ampu_1'] = $new_instance['ampu_1'];
		$instance['ampu_2'] = $new_instance['ampu_2'];
		$instance['external_links'] = $new_instance['external_links'];
		return $instance;
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Kinder-BMI-Rechner', 'wi_bmi-rechner' );
		}
		
		$wi_bmi_o1= strip_tags($instance['bmi_o1']);
		$wi_ampu_1 = esc_attr($instance['wi_ampu_1']);
		$wi_ampu_2 = esc_attr($instance['wi_ampu_2']);
		$wi_external_links = esc_attr($instance['external_links']);
		$wi_warnhinweis			= __( 'Wenn Sie &quot;Externe Links&quot; aktivieren haben Ihre Besucher die M&ouml;glichkeit eine ausf&uuml;hrliche Erkl&auml;rung zur Gewichtseinstufung ihres BMIs inkl. m&ouml;glicher Ursachenbenennung und Methoden zum Errechen des Idealgewichts abzurufen.','wi_bmi-rechner' );
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
				<p>
					<label for="<?php echo $this->get_field_id( 'ampu_1' ); ?>"><?php _e( '1. Amputiertenfeld anzeigen','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['ampu_1'], true ); ?> id="<?php echo $this->get_field_id( 'ampu_1' ); ?>" name="<?php echo $this->get_field_name( 'ampu_1' ); ?>" />
					<br />
				</p> 
				<p>
					<label for="<?php echo $this->get_field_id( 'ampu_2' ); ?>"><?php _e('2. Amputiertenfeld anzeigen','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['ampu_2'], true ); ?> id="<?php echo $this->get_field_id( 'ampu_2' ); ?>" name="<?php echo $this->get_field_name( 'ampu_2' ); ?>" />
					<br />
				</p> 
				<p>
					<label for="<?php echo $this->get_field_id( 'external_links' ); ?>"><?php _e('Externe Links','wi_bmi-rechner'); ?>:</label>
					<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['external_links'], true ); ?> id="<?php echo $this->get_field_id( 'external_links' ); ?>" name="<?php echo $this->get_field_name( 'external_links' ); ?>" />
					<br />
				</p> 
				<p>
				<i><?php
				echo $wi_warnhinweis ?></i>
				</p>
				
		<?php 
	}
	
	
	
	public function template( $name ) {
		$template	=	file(dirname(__FILE__) ."/templates/".$name.".html"); 
		$template	=	implode("",$template); 
		$template	=	str_replace("\"", "\\\"", $template); 
		return $template; 
	}


} 



add_action( 'widgets_init', create_function( '', 'register_widget( "wi_bmi_rechner_widget" );' ) );
add_action( 'widgets_init', create_function( '', 'register_widget( "wi_bmi_c_rechner_widget" );' ) );
?>