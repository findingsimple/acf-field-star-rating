<?php

class acf_field_star_rating_average extends acf_field
{
	// vars
	var $settings, // will hold info such as dir / path
		$defaults; // will hold default field options
		
		
	/*
	*  __construct
	*
	*  Set name / label needed for actions / filters
	*
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function __construct()
	{
		// vars
		$this->name = 'star_rating_average';
		$this->label = __('Star Rating Average');
		$this->category = __("Basic",'acf'); // Basic, Content, Choice, etc
		$this->defaults = array(
			// add default here to merge into your field. 
			// This makes life easy when creating the field options as you don't need to use any if( isset('') ) logic. eg:
			'number' => 5, //number of stars
		);
		
		
		// do not delete!
    	parent::__construct();
    	
    	
    	// settings
		$this->settings = array(
			'path' => apply_filters('acf/helpers/get_path', __FILE__),
			'dir' => apply_filters('acf/helpers/get_dir', __FILE__),
			'version' => '1.0.0'
		);

	}
	
	
	/*
	*  create_options()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function create_options( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
		
		// key is needed in the field names to correctly save the data
		$key = $field['name'];
		
		
		// Create Field Options HTML
		?>
		<tr class="field_option field_option_<?php echo $this->name; ?>">
			<td class="label">
				<label><?php _e("Number of Stars",'acf'); ?></label>
				<p class="description"><?php _e("Number of stars that will be presented.",'acf'); ?></p>
			</td>
			<td>
				<?php
		
				do_action('acf/create_field', array(
					'type'		=>	'text',
					'name'		=>	'fields['.$key.'][number]',
					'value'		=>	$field['number']
				));
		
				?>
			</td>
		</tr>
		<?php
		
	}
	
	
	/*
	*  create_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function create_field( $field )
	{
		// defaults?
		$field = array_merge($this->defaults, $field);
				
		$value = ( $field['value'] == $field['key']  ) ? '0' : $field['value'];

		?>
		<div class="star_rating_average"
			data-target="#star_<?php echo $field['key']; ?>"
			data-path="<?php echo $this->settings['dir'] . 'img'; ?>" 
			data-field="#<?php echo $field['key']; ?>"
		>
			<div id="<?php echo $field['key']; ?>" class="stars" 
				data-score="<?php echo $value; ?>" 
				data-number="<?php echo $field['number']; ?>" 
				>
			</div>
			<input id="star_<?php echo $field['key']; ?>" class="<?php echo $field['class']; ?>" name="<?php echo $field['name']; ?>" type="hidden" value="<?php echo $value; ?>" />
		</div>
		<?php
	}
	
	
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add css + javascript to assist your create_field() action.
	*
	*  $info	http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/

	function input_admin_enqueue_scripts()
	{
		// Note: This function can be removed if not used
		
		
		// register acf scripts
		wp_register_script( 'jquery-raty', $this->settings['dir'] . 'js/jquery.raty.min.js', array('acf-input'), $this->settings['version'] );
		wp_register_script( 'acf-input-star_rating', $this->settings['dir'] . 'js/input.js', array('acf-input'), $this->settings['version'] );
		wp_register_style( 'acf-input-star_rating', $this->settings['dir'] . 'css/input.css', array('acf-input'), $this->settings['version'] ); 
		
		
		// scripts
		wp_enqueue_script(array(
			'jquery-raty',	
		));
		wp_enqueue_script(array(
			'acf-input-star_rating',	
		));

		// styles
		wp_enqueue_style(array(
			'acf-input-star_rating',	
		));
		
	}
	
}


// create field
new acf_field_star_rating_average();

?>