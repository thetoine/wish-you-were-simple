## Wish You Were Simple

Stripped down theme for WordPress.

### function.php

#### Assets

Stylesheets and Javascripts are loaded through __wp_head()___ filter.

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

Options can be grouped by __sets__, simply populate the "options_sets" array with additional options. Access them in your theme with _get_option(option_name)_

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

### Included javascripts

* jQuery (loaded by default)
* cufon http://wiki.github.com/sorccu/cufon/about
* jQuery.corner http://www.malsup.com/jquery/corner/
* jQuery.swfobject http://jquery.thewikies.com/swfobject/

### Javascript constants

* WP_THEME_PATH = export current theme path