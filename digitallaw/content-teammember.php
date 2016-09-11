<?php
/**
 * Team Member box
 *
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */
global $digitallaw_theme_options;
$teamcat_column = ( !empty($digitallaw_theme_options['teamcat_column']) ) ? trim( esc_attr($digitallaw_theme_options['teamcat_column']) ) : 'three' ;

?>

<?php echo digitallaw_teammemberbox($teamcat_column); ?>
