<!DOCTYPE html>
<html class="elementaire <?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <!-- Google Analytics Code -->
    <script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-69276226-1', 'auto');
	ga('send', 'pageview');
    </script>  
    <!-- End Google Analytics Code --> 

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_url('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
    queue_css_file(array('iconfonts', 'normalize', 'style'), 'screen');
    queue_css_file('print', 'print');
    echo head_css();
    ?>

<?php
   	require_once( 'colors.php' );

        // Load Google Font Stylesheet for Header
	if (get_theme_option('Heading Text Font') != NULL) {
		$headingTextFont=get_theme_option('Heading Text Font');
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$headingTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	}

        // Load Google Font Stylesheet for Body
	if (get_theme_option('Body Text Font') != NULL) {
		$bodyTextFont=get_theme_option('Body Text Font');
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$bodyTextFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	}
	
	// Load Google Font Stylesheet for Nav
	if (get_theme_option('Navigation Font') != NULL) {
		$navigationFont=get_theme_option('Navigation Font');
		$googleLink="<link href='http://fonts.googleapis.com/css?family=".$navigationFont."' rel='stylesheet' type='text/css'>";
		echo $googleLink;
	}
	
	// Get color preferences from config.
	$c1 = ( get_theme_option('Color One') == NULL || get_theme_option('Color One') == '' ) ? '#343058' : get_theme_option('Color One');
	$v = ( is_light_color( hex_to_rgb( $c1 ) ) ) ?  -1 : 1;
	$c1v2 = colorBrightness( $c1, $v * 0.2 );
	$c1v3 = colorBrightness( $c1, $v * 0.3 );
	$c1v4 = colorBrightness( $c1, $v * 0.4 );
	$c1v5 = colorBrightness( $c1, $v * 0.5 );
	$c1v6 = colorBrightness( $c1, $v * 0.6 );
	$c1v7 = colorBrightness( $c1, $v * 0.7 );
	$c1v8 = colorBrightness( $c1, $v * 0.8 );
	$c1v2i = colorBrightness( $c1, $v * -0.7 );
	$c1desat = colorSaturation( $c1, -0.4 );
	$c1sat = colorSaturation( $c1, 0.4 );

	$c2 = ( get_theme_option('Color Two') == NULL || get_theme_option('Color Two') == '' ) ? '#3e8238' : get_theme_option('Color Two');
	$v = ( is_light_color( hex_to_rgb ( $c2 ) ) ) ?  -1 : 1;
	$c2v2 = colorBrightness( $c2, $v * 0.2 );
	$c2v3 = colorBrightness( $c2, $v * 0.3 );
	$c2v4 = colorBrightness( $c2, $v * 0.4 );
	$c2v5 = colorBrightness( $c2, $v * 0.5 );
	$c2v6 = colorBrightness( $c2, $v * 0.6 );
	$c2v7 = colorBrightness( $c2, $v * 0.7 );
	$c2v8 = colorBrightness( $c2, $v * 0.8 );
	$c2v2i = colorBrightness( $c2, $v * -0.7 );
	$c2desat = colorSaturation( $c2, -0.4 );
	$c2sat = colorSaturation( $c2, 0.4 );

	$c3 = get_theme_option('Color Three') ? get_theme_option('Color Three') : '#df6f1e';
	$c3v2 = colorBrightness( $c3, $v * 0.2 );
	$c3v3 = colorBrightness( $c3, $v * 0.3 );
	$c3v4 = colorBrightness( $c3, $v * 0.4 );
	$c3v5 = colorBrightness( $c3, $v * 0.5 );
	$c3v6 = colorBrightness( $c3, $v * 0.6 );
	$c3v7 = colorBrightness( $c3, $v * 0.7 );
	$c3v2i = colorBrightness( $c3, $v * -0.7 );
	$c3desat = colorSaturation( $c3, -0.4 );
	$c3sat = colorSaturation( $c3, 0.4 );

	if (get_theme_option('Heading Color') != NULL) {
		$hc = get_theme_option('Heading Color');
		$v = ( is_light_color( hex_to_rgb ( $hc ) ) ) ?  -1 : 1;
		$hcv2 = colorBrightness( $hc, $v * 0.2 );
		$hcv3 = colorBrightness( $hc, $v * 0.3 );
		$hcv4 = colorBrightness( $hc, $v * 0.4 );
		$hcv5 = colorBrightness( $hc, $v * 0.5 );
		$hcv6 = colorBrightness( $hc, $v * 0.6 );
		$hcv7 = colorBrightness( $hc, $v * 0.7 );
	}
?>

<!-- Custom Styles -->
<style type="text/css">

	header #site-title a, h1, h2, h3, h4, h5, h6 {
		<?php if (get_theme_option('Heading Text Font')) echo 'font-family: ' .  get_theme_option('Heading Text Font') . ';'; ?>			
		<?php if (get_theme_option('Heading Font Size')) echo 'font-size: ' .  get_theme_option('Heading Font Size') . ';'; ?>			
	}
	nav li a, .exhibits #exhibit-pages, .exhibits #exhibit-page-navigation a, .exhibits #exhibit-page-navigation .current-page {
		<?php if (get_theme_option('Navigation Font')) echo 'font-family: ' .  get_theme_option('Navigation Font'); ?>
	}
	body {
		font-family: <?php echo get_theme_option('Body Text Font'); ?>;
	}
	#content {
		background-image: url('<?php echo elementaire_custom_background(); ?>');
	}
	<?php if ( get_theme_option( 'Header Background' ) ): ?>
	header {
		background-image: url('<?php echo elementaire_custom_header_background(); ?>');
	}
	<?php endif; ?>

.elementaire body {
  background-color: <?php echo $c1v2i; ?>;
  color: <?php echo $c2v2i; ?>; }
.elementaire h1, .elementaire #site-title a {
  color: <?php echo ( isset( $hc ) ? $hc : $c1v2 ); ?>; }
.elementaire input[type=submit], .elementaire button, .elementaire .button, .elementaire #advanced-search {
  background-color: <?php echo $c2; ?>; }
.elementaire input[type=text], .elementaire input[type=password], .elementaire textarea {
  background-color: <?php echo $c2v4; ?>; }
.elementaire header input[type=submit], .elementaire header button, .elementaire .button, .elementaire header #advanced-search {
  background-color: <?php echo $c1; ?>; }
.elementaire header #search-form input[type=text] {
  background-color: <?php echo $c1v4; ?>; }
.elementaire a:link {
  color: <?php echo $c2v2; ?>; }
.elementaire a:visited {
  color: <?php echo $c2v2; ?>; }
.elementaire a:hover, .elementaire a:active {
  color: <?php echo $c2v4; ?>; }
.elementaire header {
	background-color: <?php echo $c1v7; ?>; }
.elementaire nav.top {
  background-color: <?php echo $c1; ?>; }
  .elementaire nav.top li:hover a {
    color: <?php echo $c1v2; ?>; }
  .elementaire nav.top a:link, .elementaire nav.top a:visited {
    color: <?php echo $c1v4; ?>; }
  .elementaire nav.top a:active, .elementaire nav.top a:hover {
    color: <?php echo $c1v8; ?>; }
  .elementaire nav.top ul li ul {
    background-color: <?php echo $c1; ?>; }
    .elementaire nav.top ul li ul li > a:link, .elementaire nav.top ul li ul li > a:visited, .elementaire nav.top ul li ul li > a:active, .elementaire nav.top ul li ul li > a:hover {
      color: <?php echo $c1v4; ?>; }
.elementaire #intro {
  color: <?php echo $c1v8; ?>; }
.elementaire #content,
.elementaire #secondary-nav .current a,
.elementaire #secondary-nav a.current,
.elementaire .secondary-nav .current a,
.elementaire .secondary-nav a.current,
.elementaire .exhibit-section-nav .current a {
  background-color: <?php echo $c1v8; ?>; }
.elementaire #home #content > div {
  border-color: <?php echo $c2; ?>; }
.elementaire #content h1 {
    color: <?php echo ( isset( $hc ) ? $hc : $c1v2 ); ?>;
  }
.elementaire #content h2 {
  border-color: <?php echo $c2v6; ?>; }
.elementaire #content div {
  border-color: <?php echo $c2; ?>; }
.elementaire #content > div, .elementaire #content #primary > div, .elementaire #content #sidebar > div,
.elementaire #content #advanced-search-form > div, .elementaire #content #exhibit-pages {
  background-color: <?php echo $c2; ?>;
  color: <?php echo $c2v2; ?>;
  border-color: <?php echo $c2v7; ?>; }
.elementaire #content #primary > div, .elementaire #content #sidebar > div {
  background-color: <?php echo $c2; ?>; }
.elementaire #content .pagination_previous a, .elementaire #content .pagination_next a {
  background-color: <?php echo $c2; ?>; }
.elementaire #content .pagination a:link, .elementaire #content .pagination a:visited {
  color: <?php echo $c2v4; ?>; }
.elementaire #content .pagination a:hover, .elementaire #content .pagination a:active {
  color: <?php echo $c2v8; ?>; }
.elementaire #content .item-pagination li {
  background-color: <?php echo $c2; ?>; }
.elementaire #content .pagination input[type=text] {
  border-color: <?php echo $c2v4; ?>; }
.elementaire #content nav .pagination_list {
  background-color: <?php echo $c1; ?>; }
.elementaire #content .page-input form {
  /* Page numbers are against $c1 background. */
	color: <?php echo $c1v2; ?>; }
.elementaire #content .page-input input {
	color: <?php echo $c2; ?>; }
.elementaire #content .items-nav a:link, .elementaire #content .items-nav a:visited, .elementaire #content #outputs a:link, .elementaire #content #outputs a:visited, .elementaire #content #exhibit-child-pages a:link, .elementaire #content #exhibit-child-pages a:visited {
  color: <?php echo $c2v6; ?>; }

/* Secondary nav is against the c1 background */
.elementaire #content .secondary-nav a:link, .elementaire #content .secondary-nav a:visited, .elementaire #content #secondary-nav a:link, .elementaire #content #secondary-nav a:visited, .elementaire #content #exhibit-child-pages a:link, .elementaire #content #exhibit-child-pages a:visited, .elementaire #content > h2, .elementaire #content > #simple-pages-breadcrumbs {
  color: <?php echo ( isset( $hc ) ? $hc : $c1v2 ); ?>; }
.elementaire #content > h2 { 
	border: 0; /* Don't use the lines you normally do. */ 
	margin-bottom: 0.3em; 
} 
.elementaire #content .secondary-nav a:hover, .elementaire #content .secondary-nav a:active, .elementaire #content #secondary-nav a:hover, .elementaire #content #secondary-nav a:active, .elementaire #content .items-nav a:hover, .elementaire #content #exhibit-child-pages a:hover {
  color: <?php echo ( isset( $hcv6 ) ? $hcv6 : $c1v6 ); ?>; }

/* ...except in exhibits. */
.exhibits .elementaire #content .secondary-nav a:link, .exhibits .elementaire #content .secondary-nav a:visited, .exhibits .elementaire #content #secondary-nav a:link, .exhibits .elementaire #content #secondary-nav a:visited {
  color: <?php echo $c2v2; ?>; }
.elementaire .exhibits #content .secondary-nav a:hover, .elementaire .exhibits #content .secondary-nav a:active, .elementaire .exhibits #content #secondary-nav a:hover, .elementaire .exhibits #content #secondary-nav a:active, .elementaire .exhibits #content .items-nav a:hover {
  color: <?php echo $c2v6; ?>; }

.elementaire #content .items-nav a:active, .elementaire #content #outputs a:hover, .elementaire #content #outputs a:active {
  color: <?php echo $c2v7; ?>; }
.elementaire #content .item-img {
  border-color: <?php echo $c2v4; ?>; }
.elementaire #content div.hTagcloud {
  border: 0;
  background-color: transparent;
  box-shadow: transparent 0 0 0; }
.elementaire #search-results th {
  background-color: <?php echo $c2; ?>; }
.elementaire #search-filters li, .elementaire #item-filters li {
  background-color: <?php echo $c2; ?>; }
.elementaire .page #content {
  border-color: <?php echo $c2; ?>; }
.elementaire footer {
  background-color: <?php echo $c1v2i; ?>; }
.elementaire footer p {
  color: <?php echo $c1v2; ?>; }
.elementaire footer a:link, .elementaire footer a:visited {
  color: <?php echo $c1v4; ?>; }
.elementaire footer a:hover {
  color: <?php echo $c1v2; ?>; }
.elementaire .exhibit-page-nav {
  background-color: <?php echo $c2; ?>; }
.elementaire .exhibit-page-nav .current, .elementaire .exhibit-child-nav .current {
  background-color: rgba(0, 0, 0, 0.1); }
.elementaire .exhibit-page-nav a:link, .elementaire .exhibit-page-nav a:visited {
  color: <?php echo $c1v4; ?>; }
.elementaire .exhibit-page-nav a:hover, .elementaire .exhibit-page-nav a:active {
  color: <?php echo $c1v8; ?>; }
.elementaire #exhibit-page-navigation a, .elementaire #exhibit-page-navigation span {
  background-color: <?php echo $c2; ?>; }
.elementaire #content div.hTagcloud ul li {
  background-color: <?php echo $c2; ?>; }

<?php if ( '1' == get_theme_option( 'Hide Header Text' ) ): ?>
	.elementaire header {
		min-height: 6em;
	}
<?php endif; ?>

<?php if ( 1 == get_theme_option('Exhibits Minimal Header') ) : ?>
	/* remove top nav for minimal header style */
	.exhibits nav.top, .exhibits #search-container {
		display: none;
	}
	/* small black minimal site header, less distracting for exhibits */
	.exhibits header {
		background-color: #000;
		padding: 0 2em;
	}
	.exhibits #site-title {
		font-size: 1em;
		padding: 0;
	}
<?php endif; ?>

.elementaire .items.browse #content .clear, .elementaire .collections.browse #content .clear, .elementaire .exhibits.browse #content .clear { 
    clear: both; 
    border: 0; 
    background-color: transparent; 
    box-shadow: none; 
    padding: 0; 
} 

<?php if ( 0 == get_theme_option('Item File Gallery') ) : ?>
	.elementaire .items.browse #content .item-description, .elementaire .items .tags {
		display: none;
	}
	.elementaire .items.browse #content .hentry, .elementaire .collections.browse #content .collection {
		display: inline-block;
		width: 30.5%;
		margin: 1%; 
	}
	.elementaire .items.browse #content .item-img, .elementaire .collections.browse #content .item-img  {
		width: 100%;
	}
	.elementaire .items.browse #content .hentry h2, .elementaire .items.browse #content .hentry h2 { 
		font-size: 1em; 
		line-height: 1.3em; 
	} 
	.elementaire #content .collection img { 
		width: 100%; 
	} 
<?php endif; ?>

</style>

    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header>
	    <?php if ( 0 == get_theme_option( 'Hide Header Text' ) ): ?>
            <div id="site-title">
                <?php echo link_to_home_page(theme_logo()); ?>
            </div>
	    <?php endif; ?>
            <div id="search-container">
                <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                <?php echo search_form(array('show_advanced' => true)); ?>
                <?php else: ?>
                <?Php echo search_form(); ?>
                <?php endif; ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
            <?php
                if(! is_current_url(WEB_ROOT)) {
                  fire_plugin_hook('public_content_top', array('view'=>$this));
                }
            ?>
