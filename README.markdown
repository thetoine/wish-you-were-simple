## Wish You Were Simple

Stripped down theme for WordPress.

### Sidebars

This theme come with 3 sidebar _zones_ (à la Drupal blocks). Your existing widgets might end up in _header_ zone by default, just move them to _sidebar_ zone.

	if ( function_exists('register_sidebar') ) {
		register_sidebar(array( 'name' => '(1) Header', 'before_widget' => '<div id="%1$s" class="header-widgets widget %2$s">', 'after_widget' => '</div>'));
	  register_sidebar(array( 'name' => '(2) Sidebar', 'before_widget' => '<li id="%1$s" class="sidebar-widgets widget %2$s">', 'after_widget' => '</li>'));
		register_sidebar(array( 'name' => '(3) Footer', 'before_widget' => '<div id="%1$s" class="footer-widgets widget %2$s">', 'after_widget' => '</div>'));
	}

### function.php


#### Assets

Stylesheets and Javascripts are loaded through __wp_head()__ filter.

Add CSS to load with __$stylesheets__ array :

	$stylesheets = array(
		"reset.css",
		"style.css"
		"some-path/my-cute-stylesheet.css"
	);

Add scripts to load with __$scripts__ array :

	$stylesheets = array(
		"reset.css",
		"style.css"
		"some-path/my-cute-stylesheet.css"
	);

__$version__ global is used for preventing browser caching. Change as you release to another random value.

#### Theme Options Page

This theme come with basic theme option that you can use in your theme file.

Options can be grouped by __sets__, simply populate the _options_sets_ array with additional options.

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
	
Access them in your theme with [_get_option(option_name)_](http://codex.wordpress.org/Function_Reference/get_option)

### Included javascripts

* jQuery (loaded by default)
* cufon [http://wiki.github.com/sorccu/cufon/about](http://wiki.github.com/sorccu/cufon/about)
* jQuery.corner [http://www.malsup.com/jquery/corner/](http://www.malsup.com/jquery/corner/)
* jQuery.swfobject [http://jquery.thewikies.com/swfobject/](http://jquery.thewikies.com/swfobject/)

### Javascript constants

* WP_THEME_PATH = export current theme path

### Credits 

* Eric Meyer's CSS reset [http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/](http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/)
* WordPress's default Kubrick theme [http://www.wordpress.org](http://www.wordpress.org)
