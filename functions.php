<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar(array( 'name' => '(1) Header', 'before_widget' => '<div id="%1$s" class="header-widgets widget %2$s">', 'after_widget' => '</div>'));
  register_sidebar(array( 'name' => '(2) Sidebar', 'before_widget' => '<li id="%1$s" class="sidebar-widgets widget %2$s">', 'after_widget' => '</li>'));
	register_sidebar(array( 'name' => '(3) Footer', 'before_widget' => '<div id="%1$s" class="footer-widgets widget %2$s">', 'after_widget' => '</div>'));
}

// theme prefix name
$theme_prefix = "wyws_";

// change this at every release, reset cache on CSS and Javascript
$version = "12345679"; //

// place any CSS to load in this array
$stylesheets = array(
	"reset.css",
	"style.css"
);

// place any scripts to load in this array
$scripts = array(
	"jquery-1.3.2.min.js",
	"cufon-yui.js",
	"main.js"
);

function load_stylesheets() {
	global $stylesheets;
	global $version;
	$path = get_bloginfo('stylesheet_directory');	
	foreach ($stylesheets as $src) {
		echo "<link rel='stylesheet' href='$path/$src?ver=$version' type='text/css' media='screen' />" . "\n";
	}
}

function load_javascripts() {
	global $scripts;
	global $version;
	$path = get_bloginfo('stylesheet_directory');	
	foreach ($scripts as $src) {		
		echo "<script src='$path/javascript/$src?ver=$version' type='text/javascript' charset='utf-8'></script>" . "\n";
	}
}

add_action('wp_head', 'load_stylesheets');
add_action('wp_head', 'load_javascripts');


// add Google Analytics tracking code to wp_footer filter
function add_google_analitics_block() {
	global $theme_prefix;
	
	$option = get_option($theme_prefix . 'google_analytics_id');
	if($option) {
	?>
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
			var pageTracker = _gat._getTracker("<?php echo $option; ?>");
			pageTracker._trackPageview();
			} catch(err) {}</script>
	<?php	
	}
}

add_filter('wp_footer', 'add_google_analitics_block');




// Admin Options page
add_action('admin_menu', 'add_options_menu');

function add_options_menu() {
	add_theme_page(__('Theme Options'), __('Theme Options'), 'edit_themes', basename(__FILE__), 'theme_options_page');
}

function theme_options_page() {
	global $theme_prefix;
	
	// options
	// add new sets and options by adding data to the array
	$options_sets = array(
		'sets' => array(
			'title' => 'Misc.',
			'intro_text' => 'Change misc. settings here.',
			'set_options' => array(
				0 => array(
					'label' => 'Google Analytics Account ID',
					'help_text' => 'Insert only your tracker ID (UA-XXXXXXX-X). Leave empty for no tracking',
					'type' => 'text', // available: text, textarea
					'option_slug' => 'google_analytics_id' // option name, slugifed, no spaces or accents
				)
			)
		)
	);
		
	
	// save each options
	if ($_REQUEST['action']) {		
		foreach ($_POST as $key => $option) {
			if($option != 'action') { // we don't want to create an option called "action"
					update_option($key, stripslashes($option));
			}
		}				
	}
	
?>
	<div class="wrap">
		<h2>Theme Options</h2>

		<div class="tool-box">
			
		<form method="post" action="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>">

			<?php foreach ($options_sets as $option_set): ?>
				<h3><?php echo $option_set['title'] ?></h3>
				<p><?php echo $option_set['intro_text'] ?></p>
				<table class="form-table">
				<?php foreach ($option_set['set_options'] as $option): ?>
					<tr valign="top">
						<th scope="row"><?php echo $option['label'] ?></th>
						<td class="<?php echo $option['type'] ?>">
						<?php if ($option['type'] == 'text'): ?>
						<input type="text" name="<?php echo $theme_prefix . $option['option_slug'] ?>" value="<?php echo get_option($theme_prefix . $option['option_slug']) ?>" />
						<?php elseif($option['type'] == 'textarea'): ?>
						<textarea name="<?php echo $theme_prefix . $option['option_slug'] ?>"><?php echo get_option($theme_prefix . $option['option_slug']) ?></textarea>
						<?php endif ?>
						<span class="description"><?php echo $option['help_text'] ?></span>
						</td>
					</tr>			
				<?php endforeach ?>
				</table>			
			<?php endforeach ?>

			<input type="hidden" name="action" value="update" />

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options') ?>" />
			</p>
		</form>

		</div>
		
	</div>
<?php
	
}
// end theme_options_page block
