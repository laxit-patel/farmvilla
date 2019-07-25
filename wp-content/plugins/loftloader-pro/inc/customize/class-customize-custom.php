<?php
if ( ! function_exists( 'llp_cutomize_control_active_cb' ) ) {
	/**
	* Customize control active callback function to test whether display current control.
	*    Dependency settings could be more than one, treat as logical AND.
	*    Each dependency setting value is array, so testing will be based on in/not in.
	* @param object WP_Csutomize_Control to test on 
	* @return boolean if depenency test not enable return true, otherwise test if current value is in the list given.
	*/
	function llp_customize_control_active_cb( $control ) {
		if ( $control instanceof WP_Customize_Control ) {
			$manager = $control->manager; 
			$setting = $control->settings; 
			$setting = !empty( $setting['default'] ) ? $setting['default'] : false;

			if ( $setting instanceof LoftLoader_Customize_Setting ) {  
				$dependency = $setting->dependency;
				if ( ! empty( $dependency ) ) {
					foreach ( $dependency as $id => $attrs ) {
						if ( ! isset( $attrs['value'] ) ) { // If not provide the test value list, return false
							return false;
						}
						if ( $manager->get_setting( $id ) instanceof WP_Customize_Setting ) {
							// Test operator, potential value: in/not in. The default is in.
							$is_not = !empty( $attrs['operator'] ) && ( strtolower( $attrs['operator'] ) == 'not in' );
							$value 	= $manager->get_setting( $id )->value();
							$values = $attrs['value'];
							if ( ( $is_not && in_array( $value, $values ) ) || ( ! $is_not && ! in_array( $value, $values ) ) ) {
								return false;
							}
						}
					}
				}
				return true;
			}
		}
		return false;
	}
}

// Add function to save the loader related options as array with option name LOFTLOADERPRO_OPTION
class LoftLoader_Customize_Setting extends WP_Customize_Setting {
	public $dependency = array();
	public function json() {
		$json = parent::json();
		return empty( $this->dependency ) ? $json : array_merge( $json, array(
			'dependency' => $this->dependency
		) );
	}	
	protected function update( $value ) {
		$updated = parent::update( $value );
		$this->save_to_file();
		return $updated;
	}
	/**
	* @description add function to generate custom styles to file when settings changed
	* @since version 1.0.7
	*/
	private function save_to_file() {
		global $llp_defaults;
		$access_type = get_filesystem_method();
		if ( ( 'file' == get_option( 'loftloader_pro_css_in_file', '' ) ) && ( 'direct' == $access_type ) ) {
			update_option( 'loftloader_pro_css_in_file_rand_version', rand() );
			$creds = request_filesystem_credentials( site_url() . '/wp-admin/', '', false, false, array() );
			/* initialize the API */
			if ( ! WP_Filesystem( $creds ) ) {
				return false;
			}

			$styles = apply_filters( 'loftloader_pro_custom_styles', '', true );

			global $wp_filesystem;
			$upload_dir = wp_upload_dir();
			$dir = $upload_dir['basedir'] . '/loftloader-pro';
			$wp_filesystem->is_dir( $upload_dir['basedir'] . '/loftloader-pro' ) ? '' : $wp_filesystem->mkdir( $upload_dir['basedir'] . '/loftloader-pro' );
			$wp_filesystem->put_contents(
				$upload_dir['basedir'] . '/loftloader-pro/custom-styles.css',
				$styles,
				FS_CHMOD_FILE // predefined mode settings for WP files
			);
		}
	}
}

// LoftLoader base section class, changed the json function to modify the customize action text
class LoftLoader_Customize_Section extends WP_Customize_Section {
	public function json() {
		$array = parent::json();
		$array['customizeAction'] = esc_html__( 'Setting', 'loftloader-pro' );
		return $array;
	}
}
// LoftLoader main switch section class, add a checkbox to control the loader
class LoftLoader_Customize_Switch_Section extends LoftLoader_Customize_Section {
	public $type = 'loftloader_switch';
	/**
	* render function for LoftLoader Switch section
	*/
	protected function render() {
		$switch = $this->manager->get_setting( 'loftloader_pro_main_switch' )->value();
		$classes = 'accordion-section control-section control-section-' . $this->type; ?>
		<li id="accordion-section-<?php echo $this->id; ?>" class="accordion-section control-section control-section-<?php echo $this->type; ?>">
			<h3 class="accordion-section-title" tabindex="0">
				<?php echo $this->title; ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Press return or enter to open this section', 'loftloader-pro' ); ?></span>
				<input type="checkbox" name="loftloader-pro-main-switch" data-customize-setting-link="loftloader_pro_main_switch" value="<?php echo esc_attr( $switch ); ?>" <?php checked( $switch, 'on' ); ?> />
			</h3>
			<ul class="accordion-section-content">
				<li class="customize-section-description-container">
					<div class="customize-section-title">
						<button class="customize-section-back" tabindex="-1">
							<span class="screen-reader-text"><?php esc_html_e( 'Back', 'loftloader-pro' ); ?></span>
						</button>
						<h3>
							<span class="customize-action"><?php esc_html_e( 'Setting', 'loftloader-pro' ); ?></span><?php echo $this->title; ?>
						</h3>
					</div>
					<?php
						if ( ! empty( $this->description ) ) {
							echo '<div class="description customize-section-description">' . $this->description . '</div>';
						}
					?>
				</li>
			</ul>
		</li> <?php
	}
}
// LoftLoader base customize control class: add class properties as displaying dependency.
class LoftLoader_Customize_Control extends WP_Customize_Control {
	public $description_above 	= true;
	public $hide 				= false;
	public $input_class 		= '';
	public $after_text 			= '%';
	public $placeholder 		= '';

	public function render_content() {
		switch ( $this->type ) {
			case 'loftloader-any-page':
				if ( ! empty( $this->label ) ) : ?> <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php endif;
				if ( ! empty( $this->description ) ) : ?> <span class="description customize-control-description"><?php echo $this->description ; ?></span> <?php endif; ?>
				<input type="button" <?php $this->link(); ?> class="button button-primary loftloader-pro-any-page-generate" value="<?php esc_attr_e( 'Generate', 'loftloader-pro' ); ?>" /><br/><br/>
				<textarea class="loftloader-pro-any-page-shortcode" cols="35" rows="4"></textarea>
				<div class="customize-control-notifications-container"></div> <?php
				break;
			case 'loftloader_post_types':
				$types = get_post_types( array( 'publicly_queryable' => true, '_builtin' => false ), 'objects' );
				$values = $this->value();
				if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php 
				endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description ; ?></span> <?php 
				endif; ?>
				<select <?php $this->link(); ?> multiple>
					<option value="post"<?php echo in_array( 'post', $values ) ? ' selected' : ''?>><?php esc_html_e( 'Posts', 'loftloader-pro' ); ?></option> <?php
					foreach ( $types as $t ) : ?>
						<option value="<?php echo $t->name; ?>"<?php echo in_array( $t->name, $values ) ? ' selected' : ''?>><?php echo esc_html( $t->label ); ?></option>
					<?php endforeach; ?>
				</select>
				<div class="customize-control-notifications-container"></div> <?php
				break;
			case 'loftloader_page_post':
				$name = $this->id;
				$pages = get_pages();
				$posts = get_posts( array( 'posts_per_page' => -1 ) ); 
				if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
				endif;
				if ( ! empty( $this->description ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->description ; ?></span> <?php 
				endif;?>
				<select <?php $this->link(); ?> multiple>
					<optgroup label="<?php esc_html_e( 'Pages', 'loftloader-pro' ); ?>">
					<?php foreach ( $pages as $p ) : ?>
						<option value="<?php echo $p->ID; ?>"<?php echo in_array( $p->ID, $this->value() ) ? ' selected' : ''?>><?php echo $p->post_title; ?></option>
					<?php endforeach; ?>
					</optgroup>
					<optgroup label="<?php esc_html_e( 'Posts', 'loftloader-pro' ); ?>">
					<?php foreach ( $posts as $p ) : ?>
						<option value="<?php echo $p->ID; ?>"<?php echo in_array( $p->ID, $this->value() ) ? ' selected' : ''?>><?php echo $p->post_title; ?></option>
					<?php endforeach; ?>
					</optgroup>
				</select>
				<div class="customize-control-notifications-container"></div> <?php
				break;
			case 'radio':
				if ( empty( $this->choices ) ) {
					return;
				}

				$description = '';
				if ( ! empty( $this->description ) && !$this->description_above ) {
					$description =sprintf(
						'<span class="description customize-control-description"%s>%s</span>', 
						( $this->hide && ( $this->hide == $this->value() ) ) ? ' style="display: none;"' : '',
						$this->description
					);
					$this->description = '';
				}
				parent::render_content();
				echo $description;
				break;
			case 'slider':
				if ( empty( $this->input_attrs ) ) {
					return;
				}

				$val = llp_sanitize_float( $this->value() );
				echo '<label class="amount opacity">';
				if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
				endif; ?>
				<span class="<?php echo $this->input_class; ?>">
					<input readonly="readonly" type="text" <?php $this->link(); ?> value="<?php echo esc_attr( $val ); ?>" >
					<?php echo $this->after_text; ?>
				</span> <?php
				echo '</label>'; ?>
				<div class="ui-slider loader-ui-slider" data-value="<?php echo $val; ?>" <?php $this->input_attrs(); ?>></div>
				<div class="customize-control-notifications-container"></div> <?php
				break;
			case 'text': ?>
				<label> <?php 
					if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
					endif;
					if ( ! empty( $this->description ) && $this->description_above ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
					endif; ?>
					<input type="text" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?><?php echo empty( $this->placeholder ) ? '' : ' placeholder="' . $this->placeholder . '"'; ?> /> <?php
					if ( ! empty( $this->description ) && ! $this->description_above ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
					endif; ?>
				</label> <?php
				break;
			case 'number':
				$unit = $this->manager->get_setting( 'loftloader_pro_progress_width_unit' )->value(); ?>
				<label> <?php
					if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
					endif;
					if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
					endif; ?>
					<span class="barwidth">
						<input type="<?php echo esc_attr( $this->type ); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
						<span class="barwidth-unit">
							<input type="checkbox" name="loftloader_pro_barwidth_unit" value="percentage" <?php checked( $unit, 'on' ); ?>>
							<span></span>
						</span>
					</span>
				</label> <?php
				break;
			case 'number-only': ?>
				<label> <?php
					if ( ! empty( $this->label ) ) : ?>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
					endif;
					if ( ! empty( $this->description ) ) : ?>
						<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
					endif; ?>
					<input type="number" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />&nbsp; &nbsp;<?php echo $this->after_text; ?>
				</label> <?php
				break;
			case 'check': ?>
				<label> <?php
				if ( ! empty( $this->label ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
				endif;
				if ( ! empty( $this->description ) && $this->description_above ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
				endif; ?>
					<input class="loftlader-pro-checkbox" type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" name="<?php echo $this->id; ?>" <?php checked( 'on', $this->value() ); ?> />
					<input style="display:none;" type="checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> <?php checked( 'on', $this->value() ); ?> /> <?php 
				if ( ! empty( $this->description ) && !$this->description_above ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
				endif; ?>
				</label> <?php
				break;
			case 'textarea':
				if ( ! empty( $this->label ) ) : ?>
					<label><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span></label> <?php 
				endif;
				if ( ! empty( $this->description ) && $this->description_above ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span>
				<?php endif; ?>
				<textarea
					rows="5"
					<?php $this->input_attrs(); ?>
					<?php $this->link(); ?>>
					<?php echo esc_textarea( $this->value() ); ?>
					<?php echo empty( $this->placeholder ) ? '' : ' placeholder="' . $this->placeholder . '"'; ?>
				</textarea> <?php
				if ( ! empty( $this->description ) && ! $this->description_above ) : ?>
					<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
				endif;
				break;
			case 'description': 
				if ( empty( $this->description ) ) {
					return ; 
				} ?>
				<span class="description-text"><?php echo $this->description; ?></span> <?php
				break;
			default:
				parent::render_content();
		}
	}
}
// Add new radio type control class, show the input horizontally.
class LoftLoader_Customize_Horizontal_Radio_Control extends LoftLoader_Customize_Control {
	public $wrap_id 			= '';
	public $show_label 			= false;
	public $description_above 	= true;
	public $hide 				= false;
	public function render_content() {
		if ( empty( $this->choices ) ) {
			return; 
		}

		$name = '_customize-radio-' . $this->id;
		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
		endif;
		if ( ! empty( $this->description ) && $this->description_above ) : ?>
			<span class="description customize-control-description"><?php echo $this->description ; ?></span> <?php
		endif;
		echo '<div id="' . ( empty($this->wrap_id ) ? 'loftloader_option_bg' : $this->wrap_id ) . '">';
		foreach ( $this->choices as $value => $attrs ) :
			$attr = '';
			$input_class = !empty( $attrs['class'] ) ? $attrs['class'] : $value;
			if ( ! empty( $attrs['attr'] ) ) {
				foreach ( (array) $attrs['attr'] as $attr_name => $attr_value ) {
					$attr .= ' ' . $attr_name . '="' . $attr_value . '"';
				}
			}
			$item_id = empty( $attrs['id'] ) ? sanitize_title( $this->id . '-' . $value ) : $attrs['id']; ?>
			<label for="<?php echo $item_id; ?>" title="<?php echo esc_attr( $attrs['label'] ); ?>">
				<input class="loftloader-radiobtn <?php echo $input_class; ?>" id="<?php echo $item_id; ?>" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> <?php echo $attr; ?> />
				<span><?php echo $this->show_label ? esc_html( $attrs['label'] ) : ''; ?></span>
			</label> <?php
		endforeach;
		echo '</div>';
		if ( ! empty( $this->description ) && !$this->description_above ) : ?>
			<span class="description customize-control-description"<?php echo ( $this->hide && ( $this->hide == $this->value() ) ) ? ' style="display: none;"' : ''; ?>><?php echo $this->description ; ?></span> <?php
		endif; ?>
		<div class="customize-control-notifications-container"></div> <?php
	}
}
// Add new radio type control class for loader animation choices.
class LoftLoader_Customize_Animation_Types_Control extends WP_Customize_Control {
	public function render_content() {
		if ( empty( $this->choices ) ){
			return;
		}

		if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
		endif;
		echo '<button class="customize-more-toggle" aria-expanded="false"><span class="screen-reader-text">' . esc_html__( 'More info', 'loftloader-pro' ) . '</span></button>';
		if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description" style="display: none;"><?php echo $this->description ; ?></span> <?php
		endif; ?>
		<div id="loftloader_option_animation"><?php
		$name = '_customize-radio-' . $this->id;
		foreach ( $this->choices as $value => $attrs ) :
			$attr = '';
			if ( ! empty( $attrs['attr'] ) ) {
				foreach ( (array) $attrs['attr'] as $attr_name => $attr_value ) {
					$attr .= ' ' . $attr_name . '="' . $attr_value . '"';
				}
			}
			$item_id = sanitize_title( $this->id . '-' . $value ); ?>
			<label for="<?php echo $item_id; ?>" title="<?php echo esc_attr( $attrs['label'] ); ?>">
				<input id="<?php echo $item_id; ?>" class="loftloader-radiobtn <?php echo $value; ?>" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> <?php echo $attr; ?> />
				<span></span>
			</label> <?php
		endforeach; ?>
		</div> <?php
	}
}
// Add new number type control class with text after the element.
class LoftLoader_Customize_Number_Text_Control extends LoftLoader_Customize_Control {
	public $after_text 			= '';
	public $input_class 		= '';
	public $input_wrap_class 	= '';
	public function render_content() { ?>
		<label> <?php 
			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> <?php
			endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> <?php
			endif; ?>
			<span class="<?php echo esc_attr( $this->input_wrap_class ); ?>">
				<input class="<?php echo esc_attr( $this->input_class ); ?>" type="<?php echo esc_attr( $this->type ); ?>" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> /><?php echo empty( $this->after_text ) ? '' : $this->after_text; ?>
			</span>
		</label> <?php
	}
}

/**
* Plugin customize config base class
*	Each config class will extend this base class
*		1. Action to register customize setting, panel, section and control
*		3. Filter to add custom styles based on theme settings for frontend
*
* @since 1.1.9
*/
class LoftLoader_Pro_Customize_Base {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customize_elements' ) );
	}
	public function register_customize_elements( $wp_customize ) { }
}
