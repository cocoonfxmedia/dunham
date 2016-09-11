<?php
/**
 * Portfolio box
 *
 *
 * @package WordPress
 * @subpackage DigitalLaw
 * @since DigitalLaw 1.0
 */
global $digitallaw_theme_options;
$pfcat_column = ( !empty($digitallaw_theme_options['pfcat_column']) ) ? trim(esc_attr($digitallaw_theme_options['pfcat_column'])) : 'three' ;

?>

<?php echo digitallaw_portfoliobox($pfcat_column); ?>
