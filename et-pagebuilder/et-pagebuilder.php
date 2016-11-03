<?php
define( 'ET_PB_VERSION', et_get_theme_version() );
define( 'ET_PB_DIR', trailingslashit( dirname(__FILE__) ) );
define( 'ET_PB_URI', get_template_directory_uri() . '/et-pagebuilder' );

// load pre-defined layouts
require_once( ET_PB_DIR . '/layouts/layouts.php' );

// exclude predefined layouts from import
function et_remove_predefined_layouts_from_import( $posts ) {
	$processed_posts = $posts;

	if ( isset( $posts ) && is_array( $posts ) ) {
		$processed_posts = array();

		foreach ( $posts as $post ) {
			if ( isset( $post['postmeta'] ) && is_array( $post['postmeta'] ) ) {
				foreach ( $post['postmeta'] as $meta ) {
					if ( '_et_pb_predefined_layout' === $meta['key'] && 'on' === $meta['value'] )
						continue 2;
				}
			}

			$processed_posts[] = $post;
		}
	}

	return $processed_posts;
}
add_filter( 'wp_import_posts', 'et_remove_predefined_layouts_from_import' );

function et_pb_export_layouts_page() {
    add_theme_page( esc_html__( 'Export Page Builder Layouts', 'Divi' ), esc_html__( 'Export Page Builder Layouts', 'Divi' ), 'export', 'et_pb_export_layouts', 'et_pb_export_layouts_interface' );

    if ( isset( $_GET['page'] ) && 'et_divi_homepage_builder' === $_GET['page'] && isset( $_POST['et_hb_action'] ) )
		et_homepage_builder_save_data();
}
add_action( 'admin_menu', 'et_pb_export_layouts_page' );

if ( ! function_exists( 'et_pb_is_pagebuilder_used' ) ) :
function et_pb_is_pagebuilder_used( $page_id ) {
	return ( 'on' === get_post_meta( $page_id, '_et_pb_use_builder', true ) );
}
endif;

if ( ! function_exists( 'et_pb_font_icon_list' ) ) :
function et_pb_font_icon_list() {
	$output = '';

	$symbols = array( '&amp;#x21;', '&amp;#x22;', '&amp;#x23;', '&amp;#x24;', '&amp;#x25;', '&amp;#x26;', '&amp;#x27;', '&amp;#x28;', '&amp;#x29;', '&amp;#x2a;', '&amp;#x2b;', '&amp;#x2c;', '&amp;#x2d;', '&amp;#x2e;', '&amp;#x2f;', '&amp;#x30;', '&amp;#x31;', '&amp;#x32;', '&amp;#x33;', '&amp;#x34;', '&amp;#x35;', '&amp;#x36;', '&amp;#x37;', '&amp;#x38;', '&amp;#x39;', '&amp;#x3a;', '&amp;#x3b;', '&amp;#x3c;', '&amp;#x3d;', '&amp;#x3e;', '&amp;#x3f;', '&amp;#x40;', '&amp;#x41;', '&amp;#x42;', '&amp;#x43;', '&amp;#x44;', '&amp;#x45;', '&amp;#x46;', '&amp;#x47;', '&amp;#x48;', '&amp;#x49;', '&amp;#x4a;', '&amp;#x4b;', '&amp;#x4c;', '&amp;#x4d;', '&amp;#x4e;', '&amp;#x4f;', '&amp;#x50;', '&amp;#x51;', '&amp;#x52;', '&amp;#x53;', '&amp;#x54;', '&amp;#x55;', '&amp;#x56;', '&amp;#x57;', '&amp;#x58;', '&amp;#x59;', '&amp;#x5a;', '&amp;#x5b;', '&amp;#x5c;', '&amp;#x5d;', '&amp;#x5e;', '&amp;#x5f;', '&amp;#x60;', '&amp;#x61;', '&amp;#x62;', '&amp;#x63;', '&amp;#x64;', '&amp;#x65;', '&amp;#x66;', '&amp;#x67;', '&amp;#x68;', '&amp;#x69;', '&amp;#x6a;', '&amp;#x6b;', '&amp;#x6c;', '&amp;#x6d;', '&amp;#x6e;', '&amp;#x6f;', '&amp;#x70;', '&amp;#x71;', '&amp;#x72;', '&amp;#x73;', '&amp;#x74;', '&amp;#x75;', '&amp;#x76;', '&amp;#x77;', '&amp;#x78;', '&amp;#x79;', '&amp;#x7a;', '&amp;#x7b;', '&amp;#x7c;', '&amp;#x7d;', '&amp;#x7e;', '&amp;#xe000;', '&amp;#xe001;', '&amp;#xe002;', '&amp;#xe003;', '&amp;#xe004;', '&amp;#xe005;', '&amp;#xe006;', '&amp;#xe007;', '&amp;#xe009;', '&amp;#xe00a;', '&amp;#xe00b;', '&amp;#xe00c;', '&amp;#xe00d;', '&amp;#xe00e;', '&amp;#xe00f;', '&amp;#xe010;', '&amp;#xe011;', '&amp;#xe012;', '&amp;#xe013;', '&amp;#xe014;', '&amp;#xe015;', '&amp;#xe016;', '&amp;#xe017;', '&amp;#xe018;', '&amp;#xe019;', '&amp;#xe01a;', '&amp;#xe01b;', '&amp;#xe01c;', '&amp;#xe01d;', '&amp;#xe01e;', '&amp;#xe01f;', '&amp;#xe020;', '&amp;#xe021;', '&amp;#xe022;', '&amp;#xe023;', '&amp;#xe024;', '&amp;#xe025;', '&amp;#xe026;', '&amp;#xe027;', '&amp;#xe028;', '&amp;#xe029;', '&amp;#xe02a;', '&amp;#xe02b;', '&amp;#xe02c;', '&amp;#xe02d;', '&amp;#xe02e;', '&amp;#xe02f;', '&amp;#xe030;', '&amp;#xe103;', '&amp;#xe0ee;', '&amp;#xe0ef;', '&amp;#xe0e8;', '&amp;#xe0ea;', '&amp;#xe101;', '&amp;#xe107;', '&amp;#xe108;', '&amp;#xe102;', '&amp;#xe106;', '&amp;#xe0eb;', '&amp;#xe010;', '&amp;#xe105;', '&amp;#xe0ed;', '&amp;#xe100;', '&amp;#xe104;', '&amp;#xe0e9;', '&amp;#xe109;', '&amp;#xe0ec;', '&amp;#xe0fe;', '&amp;#xe0f6;', '&amp;#xe0fb;', '&amp;#xe0e2;', '&amp;#xe0e3;', '&amp;#xe0f5;', '&amp;#xe0e1;', '&amp;#xe0ff;', '&amp;#xe031;', '&amp;#xe032;', '&amp;#xe033;', '&amp;#xe034;', '&amp;#xe035;', '&amp;#xe036;', '&amp;#xe037;', '&amp;#xe038;', '&amp;#xe039;', '&amp;#xe03a;', '&amp;#xe03b;', '&amp;#xe03c;', '&amp;#xe03d;', '&amp;#xe03e;', '&amp;#xe03f;', '&amp;#xe040;', '&amp;#xe041;', '&amp;#xe042;', '&amp;#xe043;', '&amp;#xe044;', '&amp;#xe045;', '&amp;#xe046;', '&amp;#xe047;', '&amp;#xe048;', '&amp;#xe049;', '&amp;#xe04a;', '&amp;#xe04b;', '&amp;#xe04c;', '&amp;#xe04d;', '&amp;#xe04e;', '&amp;#xe04f;', '&amp;#xe050;', '&amp;#xe051;', '&amp;#xe052;', '&amp;#xe053;', '&amp;#xe054;', '&amp;#xe055;', '&amp;#xe056;', '&amp;#xe057;', '&amp;#xe058;', '&amp;#xe059;', '&amp;#xe05a;', '&amp;#xe05b;', '&amp;#xe05c;', '&amp;#xe05d;', '&amp;#xe05e;', '&amp;#xe05f;', '&amp;#xe060;', '&amp;#xe061;', '&amp;#xe062;', '&amp;#xe063;', '&amp;#xe064;', '&amp;#xe065;', '&amp;#xe066;', '&amp;#xe067;', '&amp;#xe068;', '&amp;#xe069;', '&amp;#xe06a;', '&amp;#xe06b;', '&amp;#xe06c;', '&amp;#xe06d;', '&amp;#xe06e;', '&amp;#xe06f;', '&amp;#xe070;', '&amp;#xe071;', '&amp;#xe072;', '&amp;#xe073;', '&amp;#xe074;', '&amp;#xe075;', '&amp;#xe076;', '&amp;#xe077;', '&amp;#xe078;', '&amp;#xe079;', '&amp;#xe07a;', '&amp;#xe07b;', '&amp;#xe07c;', '&amp;#xe07d;', '&amp;#xe07e;', '&amp;#xe07f;', '&amp;#xe080;', '&amp;#xe081;', '&amp;#xe082;', '&amp;#xe083;', '&amp;#xe084;', '&amp;#xe085;', '&amp;#xe086;', '&amp;#xe087;', '&amp;#xe088;', '&amp;#xe089;', '&amp;#xe08a;', '&amp;#xe08b;', '&amp;#xe08c;', '&amp;#xe08d;', '&amp;#xe08e;', '&amp;#xe08f;', '&amp;#xe090;', '&amp;#xe091;', '&amp;#xe092;', '&amp;#xe0f8;', '&amp;#xe0fa;', '&amp;#xe0e7;', '&amp;#xe0fd;', '&amp;#xe0e4;', '&amp;#xe0e5;', '&amp;#xe0f7;', '&amp;#xe0e0;', '&amp;#xe0fc;', '&amp;#xe0f9;', '&amp;#xe0dd;', '&amp;#xe0f1;', '&amp;#xe0dc;', '&amp;#xe0f3;', '&amp;#xe0d8;', '&amp;#xe0db;', '&amp;#xe0f0;', '&amp;#xe0df;', '&amp;#xe0f2;', '&amp;#xe0f4;', '&amp;#xe0d9;', '&amp;#xe0da;', '&amp;#xe0de;', '&amp;#xe0e6;', '&amp;#xe093;', '&amp;#xe094;', '&amp;#xe095;', '&amp;#xe096;', '&amp;#xe097;', '&amp;#xe098;', '&amp;#xe099;', '&amp;#xe09a;', '&amp;#xe09b;', '&amp;#xe09c;', '&amp;#xe09d;', '&amp;#xe09e;', '&amp;#xe09f;', '&amp;#xe0a0;', '&amp;#xe0a1;', '&amp;#xe0a2;', '&amp;#xe0a3;', '&amp;#xe0a4;', '&amp;#xe0a5;', '&amp;#xe0a6;', '&amp;#xe0a7;', '&amp;#xe0a8;', '&amp;#xe0a9;', '&amp;#xe0aa;', '&amp;#xe0ab;', '&amp;#xe0ac;', '&amp;#xe0ad;', '&amp;#xe0ae;', '&amp;#xe0af;', '&amp;#xe0b0;', '&amp;#xe0b1;', '&amp;#xe0b2;', '&amp;#xe0b3;', '&amp;#xe0b4;', '&amp;#xe0b5;', '&amp;#xe0b6;', '&amp;#xe0b7;', '&amp;#xe0b8;', '&amp;#xe0b9;', '&amp;#xe0ba;', '&amp;#xe0bb;', '&amp;#xe0bc;', '&amp;#xe0bd;', '&amp;#xe0be;', '&amp;#xe0bf;', '&amp;#xe0c0;', '&amp;#xe0c1;', '&amp;#xe0c2;', '&amp;#xe0c3;', '&amp;#xe0c4;', '&amp;#xe0c5;', '&amp;#xe0c6;', '&amp;#xe0c7;', '&amp;#xe0c8;', '&amp;#xe0c9;', '&amp;#xe0ca;', '&amp;#xe0cb;', '&amp;#xe0cc;', '&amp;#xe0cd;', '&amp;#xe0ce;', '&amp;#xe0cf;', '&amp;#xe0d0;', '&amp;#xe0d1;', '&amp;#xe0d2;', '&amp;#xe0d3;', '&amp;#xe0d4;', '&amp;#xe0d5;', '&amp;#xe0d6;', '&amp;#xe0d7;', '&amp;#xe600;', '&amp;#xe601;', '&amp;#xe602;', '&amp;#xe603;', '&amp;#xe604;', '&amp;#xe605;', '&amp;#xe606;', '&amp;#xe607;', '&amp;#xe608;', '&amp;#xe609;', '&amp;#xe60a;', '&amp;#xe60b;', '&amp;#xe60c;', '&amp;#xe60d;', '&amp;#xe60e;', '&amp;#xe60f;', '&amp;#xe610;', '&amp;#xe611;', '&amp;#xe612;', );

	$symbols = apply_filters( 'et_pb_font_icon_symbols', $symbols );

	foreach ( $symbols as $symbol ) {
		$output .= sprintf( '<li data-icon="%1$s"></li>', esc_attr( $symbol ) );
	}

	$output = sprintf( '<ul class="et_font_icon">%1$s</ul>', $output );

	echo $output;
}
endif;

if ( ! function_exists( 'et_pb_export_layouts_interface' ) ) :
function et_pb_export_layouts_interface() {
	if ( ! current_user_can( 'export' ) )
		wp_die( __( 'You do not have sufficient permissions to export the content of this site.', 'Divi' ) );

?>
	<div class="wrap">
		<h2 id="et_page_title"><?php esc_html_e( 'Export Page Builder Layouts', 'Divi' ); ?></h2>
		<p><?php _e( 'When you click the button below WordPress will create an XML file for you to save to your computer.', 'Divi' ); ?></p>
		<p><?php _e( 'This format, which we call WordPress eXtended RSS or WXR, will contain all layouts you created using the Page Builder.', 'Divi' ); ?></p>
		<p><?php _e( 'Once you&#8217;ve saved the download file, you can use the Import function in another WordPress installation to import all layouts from this site.', 'Divi' ); ?></p>

		<form action="<?php echo esc_url( admin_url( 'export.php' ) ); ?>" method="get" id="et-pb-export-layouts">
			<input type="hidden" name="download" value="true" />
			<input type="hidden" name="content" value="et_pb_layout" />

			<?php submit_button( __('Download Export File', 'Divi') ); ?>
		</form>
<?php }
endif;

function et_pb_setup_theme(){
	add_action( 'add_meta_boxes', 'et_pb_add_custom_box' );
}
add_action( 'after_setup_theme', 'et_pb_setup_theme' );

function et_pb_before_main_editor( $post ) {
	if ( ! in_array( $post->post_type, array( 'page', 'project' ) ) ) return;

	$is_builder_used = 'on' === get_post_meta( $post->ID, '_et_pb_use_builder', true ) ? true : false;

	printf( '<a href="#" id="et_pb_toggle_builder" data-builder="%2$s" data-editor="%3$s" class="button button-primary button-large%5$s">%1$s</a><div id="et_pb_main_editor_wrap"%4$s>',
		( $is_builder_used ? __( 'Use Default Editor', 'Divi' ) : __( 'Use Page Builder', 'Divi' ) ),
		__( 'Use Page Builder', 'Divi' ),
		__( 'Use Default Editor', 'Divi' ),
		( $is_builder_used ? ' class="et_pb_hidden"' : '' ),
		( $is_builder_used ? ' et_pb_builder_is_used' : '' )
	);
}
add_action( 'edit_form_after_title', 'et_pb_before_main_editor' );

function et_pb_after_main_editor( $post ) {
	if ( ! in_array( $post->post_type, array( 'page', 'project' ) ) ) return;
	echo '</div> <!-- #et_pb_main_editor_wrap -->';
}
add_action( 'edit_form_after_editor', 'et_pb_after_main_editor' );

function et_pb_admin_scripts_styles( $hook ) {
	global $typenow;

	if ( $hook === 'widgets.php' ) {
		wp_enqueue_script( 'et_pb_widgets_js', ET_PB_URI . '/js/widgets.js', array( 'jquery' ), ET_PB_VERSION, true );

		wp_localize_script( 'et_pb_widgets_js', 'et_pb_options', array(
			'ajaxurl'             => admin_url( 'admin-ajax.php' ),
			'et_admin_load_nonce' => wp_create_nonce( 'et_admin_load_nonce' ),
			'widget_info'         => sprintf( '<div id="et_pb_widget_area_create"><p>%1$s.</p><p>%2$s.</p><p><label>%3$s <input id="et_pb_new_widget_area_name" value="" /></label></p><p class="et_pb_widget_area_result"></p><button class="button button-primary et_pb_create_widget_area">%4$s</button></div>',
				esc_html__( 'Here you can create new widget areas for use in the Sidebar module', 'Divi' ),
				esc_html__( 'Note: Naming your widget area "sidebar 1", "sidebar 2", "sidebar 3", "sidebar 4" or "sidebar 5" will cause conflicts with this theme', 'Divi' ),
				esc_html__( 'Widget Name', 'Divi' ),
				esc_html__( 'Create', 'Divi' )
			),
			'delete_string'       => esc_html__( 'Delete', 'Divi' ),
		) );

		wp_enqueue_style( 'et_pb_widgets_css', ET_PB_URI . '/css/widgets.css', array(), ET_PB_VERSION );

		return;
	}

	if ( ! in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) return;

	$post_types = apply_filters( 'et_pb_builder_post_types', array(
		'page',
		'project',
	) );

	/*
	 * Load the builder javascript and css files for custom post types
	 * custom post types can be added using et_pb_builder_post_types filter
	*/
	if ( isset( $typenow ) && in_array( $typenow, $post_types ) )
		et_pb_add_builder_page_js_css();
}
add_action( 'admin_enqueue_scripts', 'et_pb_admin_scripts_styles', 10, 1 );

function et_pb_fix_builder_shortcodes( $content ) {
	// if the builder is used for the page, get rid of random p tags
	if ( is_singular() && 'on' === get_post_meta( get_the_ID(), '_et_pb_use_builder', true ) )
		$content = et_pb_fix_shortcodes( $content );

	return $content;
}
add_filter( 'the_content', 'et_pb_fix_builder_shortcodes' );

function et_pb_video_oembed_data_parse( $return, $data, $url ) {
	if ( isset( $data->thumbnail_url ) ) {
		return esc_url( str_replace( array('https://', 'http://'), '//', $data->thumbnail_url ), array('http') );
	} else {
		return false;
	}
}

function et_pb_video_get_oembed_thumbnail() {
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die( -1 );
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		die( -1 );
	}

	$video_url = esc_url( $_POST['et_video_url'] );

	if ( false !== wp_oembed_get( $video_url ) ) {
		// Get image thumbnail
		add_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );
		// Save thumbnail
		$image_src = wp_oembed_get( $video_url );
		// Set back to normal
		remove_filter( 'oembed_dataparse', 'et_pb_video_oembed_data_parse', 10, 3 );

		if ( '' === $image_src ) {
			die( -1 );
		}

		echo esc_url( $image_src );

	} else {
		die( -1 );
	}

	die();
}
add_action( 'wp_ajax_et_pb_video_get_oembed_thumbnail', 'et_pb_video_get_oembed_thumbnail' );

function et_pb_add_widget_area(){
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die(-1);
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		die( -1 );
	}

	$et_pb_widgets = get_theme_mod( 'et_pb_widgets' );

	$number = $et_pb_widgets ? intval( $et_pb_widgets['number'] ) + 1 : 1;

	$et_pb_widgets['areas']['et_pb_widget_area_' . $number] = sanitize_text_field( $_POST['et_widget_area_name'] );
	$et_pb_widgets['number'] = $number;

	set_theme_mod( 'et_pb_widgets', $et_pb_widgets );

	printf( __( '<strong>%1$s</strong> widget area has been created. You can create more areas, once you finish update the page to see all the areas.', 'Divi' ),
		esc_html( $_POST['et_widget_area_name'] )
	);

	die();
}
add_action( 'wp_ajax_et_pb_add_widget_area', 'et_pb_add_widget_area' );

function et_pb_remove_widget_area(){
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die(-1);
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		die( -1 );
	}

	$et_pb_widgets = get_theme_mod( 'et_pb_widgets' );

	$widget_area_name = sanitize_text_field( $_POST['et_widget_area_name'] );

	unset( $et_pb_widgets['areas'][ $widget_area_name ] );

	set_theme_mod( 'et_pb_widgets', $et_pb_widgets );

	die( $widget_area_name );
}
add_action( 'wp_ajax_et_pb_remove_widget_area', 'et_pb_remove_widget_area' );

function et_pb_show_all_layouts() {
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die(-1);
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		die( -1 );
	}

	printf( '
		<label for="et_pb_load_layout_replace">
			<input name="et_pb_load_layout_replace" type="checkbox" id="et_pb_load_layout_replace" %2$s/>
			%1$s
		</label>',
		__( 'Replace the existing content with loaded layout', 'Divi' ),
		checked( get_theme_mod( 'et_pb_replace_content', 'on' ), 'on', false )
	);

	$query = new WP_Query( array(
		'meta_query'      => array(
			array(
				'key'     => '_et_pb_predefined_layout',
				'value'   => 'on',
				'compare' => 'NOT EXISTS'
			)
		),
		'post_type'       => 'et_pb_layout',
		'posts_per_page'  => '-1',
	) );

	if ( $query->have_posts() ) :
		printf( '<h3>%1$s</h3>',
			__( 'Saved Layouts:', 'Divi' )
		);

		echo '<ul class="et-pb-all-modules et-pb-load-layouts">';

		while ( $query->have_posts() ) : $query->the_post();

			printf( '<li class="et_pb_text" data-layout_id="%2$s">%1$s<span class="et_pb_layout_buttons"><a href="#" class="button-primary et_pb_layout_button_load">%3$s</a><a href="#" class="button et_pb_layout_button_delete">%4$s</a></span></li>',
				get_the_title(),
				get_the_ID(),
				esc_html__( 'Load', 'Divi' ),
				esc_html__( 'Delete', 'Divi' )
			);

		endwhile;

		echo '</ul>';
	endif;

	wp_reset_postdata();

	$query = new WP_Query( array(
		'meta_key'       => '_et_pb_predefined_layout',
		'meta_value'     => 'on',
		'post_type'      => 'et_pb_layout',
		'posts_per_page' => '-1',
		'order'          => 'ASC',
		'orderby'        => 'date',
	) );

	if ( $query->have_posts() ) :
		printf( '<h3>%1$s</h3>',
			__( 'Predefined Layouts:', 'Divi' )
		);

		echo '<ul class="et-pb-all-modules et-pb-load-layouts">';

		while ( $query->have_posts() ) : $query->the_post();

			printf( '<li class="et_pb_text" data-layout_id="%2$s">%1$s<span class="et_pb_layout_buttons"><a href="#" class="button-primary et_pb_layout_button_load">%3$s</a></span></li>',
				get_the_title(),
				get_the_ID(),
				esc_html__( 'Load', 'Divi' )
			);

		endwhile;

		echo '</ul>';
	endif;

	wp_reset_postdata();

	die();
}
add_action( 'wp_ajax_et_pb_show_all_layouts', 'et_pb_show_all_layouts' );

function et_pb_save_layout() {
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die( -1 );
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		die( -1 );
	}

	if ( '' !== $_POST['et_layout_name'] )
		et_pb_create_layout( sanitize_text_field( $_POST['et_layout_name'] ), $_POST['et_layout_content'] );

	die();
}
add_action( 'wp_ajax_et_pb_save_layout', 'et_pb_save_layout' );

function et_pb_load_layout() {
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die( -1 );
	}

	if ( ! current_user_can( 'edit_posts' ) ) {
		die( -1 );
	}

	$layout_id = (int) $_POST['et_layout_id'];

	if ( '' === $layout_id ) die( -1 );

	$replace_content = isset( $_POST['et_replace_content'] ) && 'on' === $_POST['et_replace_content'] ? 'on' : 'off';

	set_theme_mod( 'et_pb_replace_content', $replace_content );

	$layout = get_post( $layout_id );

	if ( $layout )
		echo $layout->post_content;

	die();
}
add_action( 'wp_ajax_et_pb_load_layout', 'et_pb_load_layout' );

function et_pb_delete_layout() {
	if ( ! wp_verify_nonce( $_POST['et_admin_load_nonce'], 'et_admin_load_nonce' ) ) {
		die( -1 );
	}

	if ( ! current_user_can( 'edit_others_posts' ) ) {
		die( -1 );
	}

	$layout_id = (int) $_POST['et_layout_id'];

	if ( '' === $layout_id ) die( -1 );

	wp_delete_post( $layout_id );

	die();
}
add_action( 'wp_ajax_et_pb_delete_layout', 'et_pb_delete_layout' );

if ( ! function_exists( 'et_pb_create_layout' ) ) :
function et_pb_create_layout( $name, $content, $predefined = false ) {
	$layout = array(
		'post_title'   => sanitize_text_field( $name ),
		'post_content' => $content,
		'post_status'  => 'publish',
		'post_type'    => 'et_pb_layout',
	);

	$layout_id = wp_insert_post( $layout );

	if ( $predefined )
		add_post_meta( $layout_id, '_et_pb_predefined_layout', 'on' );
}
endif;

function et_pb_add_builder_page_js_css(){
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'underscore' );
	wp_enqueue_script( 'backbone' );

	wp_enqueue_script( 'google-maps-api', esc_url( add_query_arg( array( 'v' => 3, 'sensor' => 'false' ), is_ssl() ? 'https://maps-api-ssl.google.com/maps/api/js' : 'http://maps.google.com/maps/api/js' ) ), array(), '3', true );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'wp-color-picker' );

	wp_enqueue_script( 'et_pb_admin_js', ET_PB_URI . '/js/admin.js', array( 'jquery', 'jquery-ui-core', 'underscore', 'backbone' ), ET_PB_VERSION, true );
	wp_enqueue_script( 'et_pb_admin_date_js', ET_PB_URI . '/js/jquery-ui-1.10.4.custom.min.js', array( 'jquery' ), ET_PB_VERSION, true );
	wp_enqueue_script( 'et_pb_admin_date_addon_js', ET_PB_URI . '/js/jquery-ui-timepicker-addon.js', array( 'et_pb_admin_date_js' ), ET_PB_VERSION, true );

	wp_localize_script( 'et_pb_admin_js', 'et_pb_options', array(
		'ajaxurl'                       => admin_url( 'admin-ajax.php' ),
		'et_admin_load_nonce'           => wp_create_nonce( 'et_admin_load_nonce' ),
		'images_uri'                    => get_template_directory_uri() . '/images',
		'section_only_row_dragged_away' => __( 'The section should have at least one row.', 'Divi' ),
		'fullwidth_module_dragged_away' => __( 'Fullwidth module can\'t be used outside of the Fullwidth Section.', 'Divi' ),
		'stop_dropping_3_col_row'       => __( '3 column row can\'t be used in this column.', 'Divi' ),
		'preview_image'                 => __( 'Preview', 'Divi' ),
		'empty_admin_label'             => __( 'Module', 'Divi' ),
		'video_module_image_error'      => __( 'Still images cannot be generated from this video service and/or this video format', 'Divi' ),
		'geocode_error'                 => __( 'Geocode was not successful for the following reason', 'Divi' ),
		'geocode_error_2'               => __( 'Geocoder failed due to', 'Divi' ),
		'no_results'                    => __( 'No results found', 'Divi' ),
		'module_image'                  => __( 'Image', 'Divi' ),
		'module_gallery'                => __( 'Gallery', 'Divi' ),
		'module_video'                  => __( 'Video', 'Divi' ),
		'module_video_slider'           => __( 'Video Slider', 'Divi' ),
		'module_text'                   => __( 'Text', 'Divi' ),
		'module_blurb'                  => __( 'Blurb', 'Divi' ),
		'module_tabs'                   => __( 'Tabs', 'Divi' ),
		'module_slider'                 => __( 'Slider', 'Divi' ),
		'module_testimonial'            => __( 'Testimonial', 'Divi' ),
		'module_pricing_table'          => __( 'Pricing Table', 'Divi' ),
		'module_cta'                    => __( 'Call To Action', 'Divi' ),
		'module_audio'                  => __( 'Audio', 'Divi' ),
		'module_subscribe'              => __( 'Subscribe', 'Divi' ),
		'module_login'                  => __( 'Login', 'Divi' ),
		'module_portfolio'              => __( 'Portfolio', 'Divi' ),
		'module_filterable_portfolio'   => __( 'Filterable Portfolio', 'Divi' ),
		'module_bar_counters'           => __( 'Bar Counters', 'Divi' ),
		'module_circle_counter'         => __( 'Circle Counter', 'Divi' ),
		'module_number_counter'         => __( 'Number Counter', 'Divi' ),
		'module_accordion'              => __( 'Accordion', 'Divi' ),
		'module_fullwidth_header'       => __( 'Fullwidth Header', 'Divi' ),
		'module_fullwidth_menu'         => __( 'Fullwidth Menu', 'Divi' ),
		'module_fullwidth_slider'       => __( 'Fullwidth Slider', 'Divi' ),
		'module_fullwidth_portfolio'    => __( 'Fullwidth Portfolio', 'Divi' ),
		'module_toggle'                 => __( 'Toggle', 'Divi' ),
		'module_contact_form'           => __( 'Contact Form', 'Divi' ),
		'module_sidebar'                => __( 'Sidebar', 'Divi' ),
		'module_divider'                => __( 'Divider', 'Divi' ),
		'module_person'                 => __( 'Person', 'Divi' ),
		'module_blog'                   => __( 'Blog', 'Divi' ),
		'module_shop'                   => __( 'Shop', 'Divi' ),
		'module_countdown_timer'        => __( 'Countdown Timer', 'Divi' ),
		'module_map'                    => __( 'Map', 'Divi' ),
		'module_fullwidth_map'          => __( 'Fullwidth Map', 'Divi' ),
		'module_social_media_follow'    => __( 'Social Media Follow', 'Divi' ),
	) );

	wp_enqueue_style( 'et_pb_admin_css', ET_PB_URI . '/css/style.css', array(), ET_PB_VERSION );
	wp_enqueue_style( 'et_pb_admin_date_css', ET_PB_URI . '/css/jquery-ui-1.10.4.custom.css', array(), ET_PB_VERSION );
}

function et_pb_add_custom_box() {
	$post_types = apply_filters( 'et_pb_builder_post_types', array(
		'page',
		'project',
	) );

	foreach ( $post_types as $post_type ){
		add_meta_box( 'et_pb_layout', __( 'Page Builder', 'Divi' ), 'et_pb_pagebuilder_meta_box', $post_type, 'normal', 'high' );
	}
}

function et_pb_pagebuilder_meta_box() {
	do_action( 'et_pb_before_page_builder' );

	echo '<div id="et_pb_hidden_editor">';
	wp_editor( '', 'et_pb_content_new', array( 'media_buttons' => true ) );
	echo '</div>';
echo <<<END
	<div id="et_pb_main_container"></div>

	<script type="text/template" id="et-builder-app-template">
		<div id="et_pb_layout_controls">
			<a href="#" class="et-pb-layout-buttons et-pb-layout-buttons-save"><span>
END;
esc_html_e( 'Save Layout', 'Divi' );
echo <<<END
</span></a>
			<a href="#" class="et-pb-layout-buttons et-pb-layout-buttons-load"><span>
END;
esc_html_e( 'Load Layout', 'Divi' );
echo <<<END
</span></a>
			<a href="#" class="et-pb-layout-buttons et-pb-layout-buttons-clear"><span>
END;
esc_html_e( 'Clear Layout', 'Divi' );
echo <<<END
</span></a>
		</div>
	</script>

	<script type="text/template" id="et-builder-section-template">
		<div class="et-pb-controls">
			<a href="#" class="et-pb-settings et-pb-settings-section"><span>
END;
esc_html_e( 'Settings', 'Divi' );
echo <<<END
</span></a>
			<a href="#" class="et-pb-clone et-pb-clone-section"><span>
END;
esc_html_e( 'Clone Section', 'Divi' );
echo <<<END
</span></a>
			<a href="#" class="et-pb-remove"><span>
END;
esc_html_e( 'Delete Section', 'Divi' );
echo <<<END
</span></a>
		</div>

		<div class="et-pb-section-content et-pb-data-cid" data-cid="<%= cid %>">
		</div>

		<a href="#" class="et-pb-section-add"><span class="et-pb-section-add-main">
END;
esc_html_e( 'Add Section', 'Divi' );
echo <<<END
</span><span class="et-pb-section-add-fullwidth">
END;
esc_html_e( 'Add Fullwidth Section', 'Divi' );
echo <<<END
</span><span class="et-pb-section-add-specialty">
END;
esc_html_e( 'Add Specialty Section', 'Divi' );
echo <<<END
</span></a>
	</script>

	<script type="text/template" id="et-builder-row-template">
		<div class="et-pb-controls">
			<a href="#" class="et-pb-clone et-pb-clone-row"><span>
END;
esc_html_e( 'Clone Row', 'Divi' );
echo <<<END
</span></a>
			<a href="#" class="et-pb-remove"><span>
END;
esc_html_e( 'Delete Row', 'Divi' );
echo <<<END
</span></a>
		</div>

		<div class="et-pb-row-content et-pb-data-cid" data-cid="<%= cid %>">
			<div class="et-pb-row-container"></div>
			<a href="#" class="et-pb-insert-column"><span>
END;
esc_html_e( 'Insert Column(s)', 'Divi' );
echo <<<END
</span></a>
		</div>

		<a href="#" class="et-pb-row-add"><span>
END;
esc_html_e( 'Add Row', 'Divi' );
echo <<<END
</span></a>
	</script>

	<script type="text/template" id="et-builder-block-module-template">
		<a href="#" class="et-pb-settings"><span>
END;
esc_html_e( 'Module Settings', 'Divi' );
echo <<<END
</span></a>
		<a href="#" class="et-pb-clone et-pb-clone-module"><span>
END;
esc_html_e( 'Clone Module', 'Divi' );
echo <<<END
</span></a>
		<a href="#" class="et-pb-remove"><span>
END;
esc_html_e( 'Delete Module', 'Divi' );
echo <<<END
</span></a>
		<span class="et-pb-module-title"><%= admin_label %></span>
	</script>

	<script type="text/template" id="et-builder-modal-template">
		<div class="et-pb-modal-container">
			<a href="#" class="et-pb-modal-close"><span>
END;
esc_html_e( 'Close modal window', 'Divi' );
echo <<<END
</span></a>

		<% if ( ! ( typeof open_view !== 'undefined' && open_view === 'column_specialty_settings' ) && typeof type !== 'undefined' && ( type === 'module' || type === 'section' ) ) { %>
			<div class="et-pb-modal-bottom-container">
				<a href="#" class="et-pb-modal-save button button-primary"><span>
END;
esc_html_e( 'Save', 'Divi' );
echo <<<END
</span></a>
			</div>
		<% } %>
		</div>
	</script>

	<script type="text/template" id="et-builder-column-settings-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Insert Columns', 'Divi' );
echo <<<END
</h3>
		<div class="et-pb-main-settings et-pb-main-settings-full">
			<ul class="et-pb-column-layouts">
			<% if ( typeof et_pb_specialty !== 'undefined' && et_pb_specialty === 'on' ) { %>
				<li data-layout="1_2,1_2" data-specialty="1,0" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_specialty_column"></div>
				</li>

				<li data-layout="1_2,1_2" data-specialty="0,1" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_specialty_column"></div>

					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
				</li>

				<li data-layout="1_4,3_4" data-specialty="0,1" data-specialty_columns="3">
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_3_4 et_pb_variations et_pb_3_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_3"></div>
							<div class="et_pb_variation et_pb_variation_1_3"></div>
							<div class="et_pb_variation et_pb_variation_1_3"></div>
						</div>
					</div>
				</li>

				<li data-layout="3_4,1_4" data-specialty="1,0" data-specialty_columns="3">
					<div class="et_pb_layout_column et_pb_column_layout_3_4 et_pb_variations et_pb_3_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_3"></div>
							<div class="et_pb_variation et_pb_variation_1_3"></div>
							<div class="et_pb_variation et_pb_variation_1_3"></div>
						</div>
					</div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
				</li>

				<li data-layout="1_4,1_2,1_4" data-specialty="0,1,0" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
				</li>

				<li data-layout="1_2,1_4,1_4" data-specialty="1,0,0" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
				</li>

				<li data-layout="1_4,1_4,1_2" data-specialty="0,0,1" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
				</li>

				<li data-layout="1_3,2_3" data-specialty="0,1" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_1_3 et_pb_specialty_column"></div>
					<div class="et_pb_layout_column et_pb_column_layout_2_3 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
				</li>

				<li data-layout="2_3,1_3" data-specialty="1,0" data-specialty_columns="2">
					<div class="et_pb_layout_column et_pb_column_layout_2_3 et_pb_variations et_pb_2_variations">
						<div class="et_pb_variation et_pb_variation_full"></div>
						<div class="et_pb_variation_row">
							<div class="et_pb_variation et_pb_variation_1_2"></div>
							<div class="et_pb_variation et_pb_variation_1_2"></div>
						</div>
					</div>
					<div class="et_pb_layout_column et_pb_column_layout_1_3 et_pb_specialty_column"></div>
				</li>
			<% } else if ( typeof view !== 'undefined' && typeof view.model.attributes.specialty_columns !== 'undefined' ) { %>
				<li data-layout="4_4">
					<div class="et_pb_layout_column et_pb_column_layout_fullwidth"></div>
				</li>
				<li data-layout="1_2,1_2">
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
				</li>

				<% if ( view.model.attributes.specialty_columns === 3 ) { %>
					<li data-layout="1_3,1_3,1_3">
						<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
						<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
						<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
					</li>
				<% } %>
			<% } else { %>
				<li data-layout="4_4">
					<div class="et_pb_layout_column et_pb_column_layout_fullwidth"></div>
				</li>
				<li data-layout="1_2,1_2">
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
				</li>
				<li data-layout="1_3,1_3,1_3">
					<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
				</li>
				<li data-layout="1_4,1_4,1_4,1_4">
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
				</li>
				<li data-layout="2_3,1_3">
					<div class="et_pb_layout_column et_pb_column_layout_2_3"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
				</li>
				<li data-layout="1_3,2_3">
					<div class="et_pb_layout_column et_pb_column_layout_1_3"></div>
					<div class="et_pb_layout_column et_pb_column_layout_2_3"></div>
				</li>
				<li data-layout="1_4,3_4">
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_3_4"></div>
				</li>
				<li data-layout="3_4,1_4">
					<div class="et_pb_layout_column et_pb_column_layout_3_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
				</li>
				<li data-layout="1_2,1_4,1_4">
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
				</li>
				<li data-layout="1_4,1_4,1_2">
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
				</li>
				<li data-layout="1_4,1_2,1_4">
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_2"></div>
					<div class="et_pb_layout_column et_pb_column_layout_1_4"></div>
				</li>
			<% } %>
			</ul>
		</div>
	</script>

	<script type="text/template" id="et-builder-modules-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Insert Module', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings et-pb-main-settings-full">
			<ul class="et-pb-all-modules">
			<% _.each(modules, function(module) { %>
				<li class="<%= module.label %><%
				if ( typeof module.fullwidth_only !== 'undefined' && module.fullwidth_only === 'on' ) { %> et_pb_fullwidth_only_module<% } %>">
					<span class="et_module_title"><%= module.title %></span>
				</li>
			<% }); %>
			</ul>
		</div>
	</script>

	<script type="text/template" id="et-builder-load_layout-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Load Layout', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings et-pb-main-settings-full">

		</div>
	</script>

	<script type="text/template" id="et-builder-section-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Section Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_background_image">
END;
esc_html_e( 'Background Image', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_image" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_background_image ) !== 'undefined' ?  et_pb_background_image : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Background Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background', 'Divi' );
echo <<<END
" data-type="image" />

					<p class="description">
END;
esc_html_e( 'If defined, this image will be used as the background for this module. To remove a background image, simply delete the URL from the settings field.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_transparent_background">
END;
esc_html_e( 'Transparent Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<select name="et_pb_transparent_background" id="et_pb_transparent_background" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="off"<%= typeof( et_pb_transparent_background ) !== 'undefined' && 'off' === et_pb_transparent_background ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_transparent_background ) !== 'undefined' && 'on' === et_pb_transparent_background ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
					</select>
					<p class="description">
END;
esc_html_e( 'Switch on this option if you need transparent background color for the section.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="off">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#ffffff' %>" />
					<p class="description">
END;
esc_html_e( 'Define a custom background color for your module, or leave blank to use the default color.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_video_mp4">
END;
esc_html_e( 'Background Video MP4', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_video_mp4" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_background_video_mp4 ) !== 'undefined' ?  et_pb_background_video_mp4 : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Background Video MP4 File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background Video', 'Divi' );
echo <<<END
" data-type="video" />

					<p class="description">
END;
esc_html_e( 'All videos should be uploaded in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers. Upload the .MP4 version here. <b>Important Note: Video backgrounds are disabled from mobile devices. Instead, your background image will be used. For this reason, you should define both a background image and a background video to ensure best results.</b>', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_video_webm">
END;
esc_html_e( 'Background Video Webm', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_video_webm" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_background_video_webm ) !== 'undefined' ?  et_pb_background_video_webm : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='Upload a video' data-choose="
END;
esc_html_e( 'Choose a Background Video WEBM File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'All videos should be uploaded in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers. Upload the .WEBM version here. <b>Important Note: Video backgrounds are disabled from mobile devices. Instead, your background image will be used. For this reason, you should define both a background image and a background video to ensure best results.</b>', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_video_width">
END;
esc_html_e( 'Background Video Width', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_video_width" type="text" class="regular-text" value="<%= typeof( et_pb_background_video_width ) !== 'undefined' ?  et_pb_background_video_width : '' %>" />
					<p class="description">
END;
esc_html_e( 'In order for videos to be sized correctly, you must input the exact width (in pixels) of your video here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_video_height">
END;
esc_html_e( 'Background Video Height', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_video_height" type="text" class="regular-text" value="<%= typeof( et_pb_background_video_height ) !== 'undefined' ?  et_pb_background_video_height : '' %>" />
					<p class="description">
END;
esc_html_e( 'In order for videos to be sized correctly, you must input the exact height (in pixels) of your video here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_allow_player_pause">
END;
esc_html_e( 'Pause Video', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_allow_player_pause" id="et_pb_allow_player_pause">
						<option value="off"<%= typeof( et_pb_allow_player_pause ) !== 'undefined' && 'off' === et_pb_allow_player_pause ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_allow_player_pause ) !== 'undefined' && 'on' === et_pb_allow_player_pause ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Allow video to be paused by other players when they begin playing', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_inner_shadow">
END;
esc_html_e( 'Inner Shadow', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_inner_shadow" id="et_pb_inner_shadow">
						<option value="off"<%= typeof( et_pb_inner_shadow ) !== 'undefined' && 'off' === et_pb_inner_shadow ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Inner Shadow", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_inner_shadow ) !== 'undefined' && 'on' === et_pb_inner_shadow ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Inner Shadow', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can select whether or not your section has an inner shadow. This can look great when you have colored backgrounds or background images.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_parallax">
END;
esc_html_e( 'Parallax effect', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax" id="et_pb_parallax" class="et-pb-affects" data-affects="#et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax ) !== 'undefined' && 'off' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Use Parallax Effect", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax ) !== 'undefined' && 'on' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Use Parallax Effect', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'If enabled, your background image will stay fixed as your scroll, creating a fun parallax-like effect.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="on">
				<label for="et_pb_parallax_method">
END;
esc_html_e( 'Parallax method', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax_method" id="et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'off' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'CSS', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'on' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'True Parallax', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Define the method, used for the parallax effect.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_image-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Image Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_src">
END;
esc_html_e( 'Image URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_src" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_src ) !== 'undefined' ?  et_pb_src : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_alt">
END;
esc_html_e( 'Image Alternative Text', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_alt" type="text" class="regular-text" value="<%= typeof( et_pb_alt ) !== 'undefined' ?  et_pb_alt : '' %>" />
					<p class="description">
END;
esc_html_e( 'This defines the HTML ALT text. A short description of your image can be placed here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_title_text">
END;
esc_html_e( 'Image Title Text', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_title_text" type="text" class="regular-text" value="<%= typeof( et_pb_title_text ) !== 'undefined' ?  et_pb_title_text : '' %>" />
					<p class="description">
END;
esc_html_e( 'This defines the HTML Title text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_in_lightbox">
END;
esc_html_e( 'Lightbox', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_in_lightbox" id="et_pb_show_in_lightbox" class="et-pb-affects" data-affects="#et_pb_url, #et_pb_url_new_window">
						<option value="off"<%= typeof( et_pb_show_in_lightbox ) !== 'undefined' && 'off' === et_pb_show_in_lightbox ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Open In Lightbox", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_show_in_lightbox ) !== 'undefined' && 'on' === et_pb_show_in_lightbox ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Open In Lightbox', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not the image should open in Lightbox. Note: if you select to open the image in Lightbox, url options below will be ignored.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="off">
				<label for="et_pb_url">
END;
esc_html_e( 'Link URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_url" type="text" class="regular-text" value="<%= typeof( et_pb_url ) !== 'undefined' ?  et_pb_url : '' %>" />
					<p class="description">
END;
esc_html_e( 'If you would like your image to be a link, input your destination URL here. No link will be created if this field is left blank.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="off">
				<label for="et_pb_url_new_window">
END;
esc_html_e( 'Url Opens', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_url_new_window" id="et_pb_url_new_window">
						<option value="off"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'off' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The Same Window', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'on' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The New Tab', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not your link opens in a new window', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_animation">
END;
esc_html_e( 'Animation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_animation" id="et_pb_animation">
						<option value="left"<%= typeof( et_pb_animation ) !== 'undefined' && 'left' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left To Right', 'Divi' );
echo <<<END
</option>
						<option value="right"<%= typeof( et_pb_animation ) !== 'undefined' && 'right' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right To Left', 'Divi' );
echo <<<END
</option>
						<option value="top"<%= typeof( et_pb_animation ) !== 'undefined' && 'top' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Top To Bottom', 'Divi' );
echo <<<END
</option>
						<option value="bottom"<%= typeof( et_pb_animation ) !== 'undefined' && 'bottom' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Bottom To Top', 'Divi' );
echo <<<END
</option>
						<option value="fade_in"<%= typeof( et_pb_animation ) !== 'undefined' && 'fade_in' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Fade In', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_animation ) !== 'undefined' && 'off' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No Animation', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This controls the direction of the lazy-loading animation.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_sticky">
END;
esc_html_e( 'Remove Space Below The Image', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_sticky" id="et_pb_sticky">
						<option value="off"<%= typeof( et_pb_sticky ) !== 'undefined' && 'off' === et_pb_sticky ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_sticky ) !== 'undefined' && 'on' === et_pb_sticky ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not the image should have a space below it.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_gallery-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Gallery Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_src">
END;
esc_html_e( 'Gallery Images', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_gallery_ids" type="hidden" class="regular-text et-pb-gallery-ids-field" value="<%= typeof( et_pb_gallery_ids ) !== 'undefined' ?  et_pb_gallery_ids : '' %>" />
					<input id="et_pb_gallery_orderby" type="hidden" class="regular-text et-pb-gallery-orderby-field" value="<%= typeof( et_pb_gallery_orderby ) !== 'undefined' ?  et_pb_gallery_orderby : '' %>" />
					<input type='button' class='button button-upload et-pb-gallery-button' value='
END;
esc_html_e( 'Update Gallery', 'Divi' );
echo <<<END
' />
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_fullwidth">
END;
esc_html_e( 'Layout', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Slider', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Grid', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Toggle between the various blog layout types.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Images Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '4' %>" />

					<p class="description">
END;
esc_html_e( 'Define the number of images that should be displayed per page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_title_and_caption">
END;
esc_html_e( 'Show Title and Caption', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_title_and_caption" id="et_pb_show_title_and_caption">
						<option value="on"<%= typeof( et_pb_show_title_and_caption ) !== 'undefined' && 'on' === et_pb_show_title_and_caption ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_title_and_caption ) !== 'undefined' && 'off' === et_pb_show_title_and_caption ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether to show the images title and caption, if the image has them.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Pagination', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Pagination', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Pagination", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Enable or disable pagination for this feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_video-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Video Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_src">
END;
esc_html_e( 'Video MP4/URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_src" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_src ) !== 'undefined' ?  et_pb_src : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Video MP4 File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_src_webm">
END;
esc_html_e( 'Video Webm', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_src_webm" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_src_webm ) !== 'undefined' ?  et_pb_src_webm : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Video WEBM File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'Upload the .WEBM version of your video here. All uploaded videos should be in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image_src">
END;
esc_html_e( 'Image Overlay URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_image_src" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image_src ) !== 'undefined' ?  et_pb_image_src : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<input type='button' class='button et-pb-video-image-button' value='
END;
esc_html_e( 'Generate From Video', 'Divi' );
echo <<<END
' />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display over your video. You can also generate a still image from your video.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_video_slider-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Video Slider Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_video_slider_item">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Video', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_image_overlay">
END;
esc_html_e( 'Display Image Overlays on Main Video', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_image_overlay" id="et_pb_show_image_overlay">
						<option value="hide"<%= typeof( et_pb_show_image_overlay ) !== 'undefined' && 'hide' === et_pb_show_image_overlay ? ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide', 'Divi' );
echo <<<END
</option>
						<option value="show"<%= typeof( et_pb_show_image_overlay ) !== 'undefined' && 'show' === et_pb_show_image_overlay ? ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This option will cover the player UI on the main video. This image can either be uploaded in each video setting or auto-generated by Divi.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_arrows">
END;
esc_html_e( 'Arrows', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_arrows" id="et_pb_show_arrows">
						<option value="on"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'on' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Arrows', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'off' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide Arrows', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will turn on and off the navigation arrows.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_thumbnails">
END;
esc_html_e( 'Slider Controls', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_thumbnails" id="et_pb_show_thumbnails">
						<option value="on"<%= typeof( et_pb_show_thumbnails ) !== 'undefined' && 'on' === et_pb_show_thumbnails ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Use Thumbnail Track', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_thumbnails ) !== 'undefined' && 'off' === et_pb_show_thumbnails ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Use Dot Navigation', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will let you choose to use the thumbnail track controls below the slider or dot navigation at the bottom of the slider.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Slider Controls Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_controls_color" id="et_pb_controls_color">
						<option value="light"<%= typeof( et_pb_controls_color ) !== 'undefined' && 'light' === et_pb_controls_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_controls_color ) !== 'undefined' && 'dark' === et_pb_controls_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will make your slider controls either light or dark in color. Slider controls are either the arrows on the thumbnail track or the circles in dot navigation.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your slider here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_video_slider_item-title">
		<%= typeof( et_pb_admin_title ) !== 'undefined' && typeof( et_pb_admin_title ) === 'string' ?  et_pb_admin_title : '
END;
esc_html_e( 'New Video', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_video_slider_item">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Video Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_admin_title">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_admin_title" type="text" class="regular-text" value="<%= typeof( et_pb_admin_title ) !== 'undefined' ?  et_pb_admin_title : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the video in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_src">
END;
esc_html_e( 'Video MP4/URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_src" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_src ) !== 'undefined' ?  et_pb_src : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Video MP4 File', 'Divi' );
echo <<<END
" data-update="Set As Video" data-type="video" />
					<p class="description">
END;
esc_html_e( 'Upload your desired video in .MP4 format, or type in the URL to the video you would like to display', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_src_webm">
END;
esc_html_e( 'Video Webm', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_src_webm" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_src_webm ) !== 'undefined' ?  et_pb_src_webm : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Video WEBM File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'Upload the .WEBM version of your video here. All uploaded videos should be in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image_src">
END;
esc_html_e( 'Image Overlay URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_image_src" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image_src ) !== 'undefined' ?  et_pb_image_src : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<input type='button' class='button et-pb-video-image-button' value='
END;
esc_html_e( 'Generate From Video', 'Divi' );
echo <<<END
' />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display over your video. You can also generate a still image from your video.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Slider Arrows Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will make your slider arrows either light or dark in color.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_text-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Text Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;

if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>

					<p class="description">
END;
esc_html_e( 'This controls the how your text is aligned within the module.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can create the content that will be used within the module.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div> <!-- .et-pb-main-settings -->
	</script>

	<script type="text/template" id="et-builder-advanced-setting">
		<a href="#" class="et-pb-advanced-setting-remove"><span>
END;
esc_html_e( 'Delete', 'Divi' );
echo <<<END
</span></a>
		<a href="#" class="et-pb-advanced-setting-options"><span>
END;
esc_html_e( 'Settings', 'Divi' );
echo <<<END
</span></a>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-edit">
		<div class="et-pb-modal-container">
			<a href="#" class="et-pb-modal-close"><span>
END;
esc_html_e( 'Close modal window', 'Divi' );
echo <<<END
</span></a>
			<div class="et-pb-modal-bottom-container">
				<a href="#" class="et-pb-modal-save button button-primary"><span>
END;
esc_html_e( 'Save', 'Divi' );
echo <<<END
</span></a>
			</div>
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_tab-title">
		<%= typeof( et_pb_title ) !== 'undefined' && typeof( et_pb_title ) === 'string' ?  et_pb_title : '
END;
esc_html_e( 'New Tab', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_tab">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Tab Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'The title will be used within the tab button for this tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the current tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_tabs-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Tabs Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_tab">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Tab', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the current tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_slider-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Slider Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_slide">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Slide', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_arrows">
END;
esc_html_e( 'Arrows', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_arrows" id="et_pb_show_arrows">
						<option value="on"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'on' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Arrows', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'off' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide Arrows', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will turn on and off the navigation arrows.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Controls', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Slider Controls', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide Slider Controls', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting will turn on and off the circle buttons at the bottom of the slider.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_auto">
END;
esc_html_e( 'Automatic Animation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_auto" id="et_pb_auto" class="et-pb-affects" data-affects="#et_pb_auto_speed">
						<option value="off"<%= typeof( et_pb_auto ) !== 'undefined' && 'off' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Disabled', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_auto ) !== 'undefined' && 'on' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Enabled', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'If you would like the slider to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_auto_speed">
END;
esc_html_e( 'Automatic Animation Speed (in ms)', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_auto_speed" type="text" class="regular-text" value="<%= typeof( et_pb_auto_speed ) !== 'undefined' ?  et_pb_auto_speed : '' %>" />
					<p class="description">
END;
esc_html_e( "Here you can designate how fast the slider fades between each slide, if 'Automatic Animation' option is enabled above. The higher the number the longer the pause between each rotation.", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_parallax">
END;
esc_html_e( 'Parallax effect', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax" id="et_pb_parallax" class="et-pb-affects" data-affects="#et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax ) !== 'undefined' && 'off' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Use Parallax Effect", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax ) !== 'undefined' && 'on' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Use Parallax Effect', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Enabling this option will give your background images a fixed position as you scroll.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="on">
				<label for="et_pb_parallax_method">
END;
esc_html_e( 'Parallax method', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax_method" id="et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'off' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'CSS', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'on' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'True Parallax', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Define the method, used for the parallax effect.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your slider here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_fullwidth_slider-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Fullwidth Slider Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_slide">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Slide', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_arrows">
END;
esc_html_e( 'Arrows', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_arrows" id="et_pb_show_arrows">
						<option value="on"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'on' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Arrows', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_arrows ) !== 'undefined' && 'off' === et_pb_show_arrows ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide Arrows', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting allows you to turn the navigation arrows on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Controls', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Slider Controls', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hide Slider Controls', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Disabling this option will remove the circle button at the bottom of the slider.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_auto">
END;
esc_html_e( 'Automatic Animation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_auto" id="et_pb_auto" class="et-pb-affects" data-affects="#et_pb_auto_speed">
						<option value="off"<%= typeof( et_pb_auto ) !== 'undefined' && 'off' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Disabled', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_auto ) !== 'undefined' && 'on' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Enabled', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'If you would like the slider to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_auto_speed">
END;
esc_html_e( 'Automatic Animation Speed (in ms)', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_auto_speed" type="text" class="regular-text" value="<%= typeof( et_pb_auto_speed ) !== 'undefined' ?  et_pb_auto_speed : '' %>" />
					<p class="description">
END;
esc_html_e( "Here you can designate how fast the slider fades between each slide, if 'Automatic Animation' option is enabled above. The higher the number the longer the pause between each rotation.", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_parallax">
END;
esc_html_e( 'Parallax effect', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax" id="et_pb_parallax" class="et-pb-affects" data-affects="#et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax ) !== 'undefined' && 'off' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Use Parallax Effect", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax ) !== 'undefined' && 'on' === et_pb_parallax ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Use Parallax Effect', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'If enabled, your background images will have a fixed position as your scroll, creating a fun parallax-like effect.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="on">
				<label for="et_pb_parallax_method">
END;
esc_html_e( 'Parallax method', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_parallax_method" id="et_pb_parallax_method">
						<option value="off"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'off' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'CSS', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_parallax_method ) !== 'undefined' && 'on' === et_pb_parallax_method ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'True Parallax', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Define the method, used for the parallax effect.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the text content that will be used in this slide.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_slide-title">
		<%= typeof( et_pb_heading ) !== 'undefined' && typeof( et_pb_heading ) === 'string' ?  et_pb_heading : '
END;
esc_html_e( 'New Slide', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_slide">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Slide Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_heading">
END;
esc_html_e( 'Heading', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_heading" type="text" class="regular-text" value="<%= typeof( et_pb_heading ) !== 'undefined' ?  et_pb_heading : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define the title text for your slide.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_text">
END;
esc_html_e( 'Button Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_text" type="text" class="regular-text" value="<%= typeof( et_pb_button_text ) !== 'undefined' ?  et_pb_button_text : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define the text for the slide button', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_link">
END;
esc_html_e( 'Button URL', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_link" type="text" class="regular-text" value="<%= typeof( et_pb_button_link ) !== 'undefined' ?  et_pb_button_link : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input a destination URL for the slide button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_image">
END;
esc_html_e( 'Background Image', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_background_image" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_background_image ) !== 'undefined' ?  et_pb_background_image : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Background Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background', 'Divi' );
echo <<<END
" data-type="image" />
					<p class="description">
END;
esc_html_e( 'If defined, this image will be used as the background for this module. To remove a background image, simply delete the URL from the settings field.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#ffffff' %>" />
					<p class="description">
END;
esc_html_e( 'Use the color picker to choose a background color for this module.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image">
END;
esc_html_e( 'Slide Image', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_image" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image ) !== 'undefined' ?  et_pb_image : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an Image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Slide Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Slide Image', 'Divi' );
echo <<<END
" data-type="image" />

					<p class="description">
END;
esc_html_e( 'If defined, this slide image will appear to the left of your slide text. Upload an image, or leave blank for a text-only slide.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_alignment">
END;
esc_html_e( 'Slide Image Vertical Alignment', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_alignment" id="et_pb_alignment">
						<option value="center"<%= typeof( et_pb_alignment ) !== 'undefined' && 'center' === et_pb_alignment ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
						<option value="bottom"<%= typeof( et_pb_alignment ) !== 'undefined' && 'bottom' === et_pb_alignment ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Bottom', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This setting determines the vertical alignment of your slide image. Your image can either be vertically centered, or aligned to the bottom of your slide.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_video_url">
END;
esc_html_e( 'Slide Video', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_video_url" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_video_url ) !== 'undefined' ?  et_pb_video_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'If defined, this video will appear to the left of your slide text. Enter youtube or vimeo page url, or leave blank for a text-only slide.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image_alt">
END;
esc_html_e( 'Image Alternative Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_image_alt" type="text" class="regular-text" value="<%= typeof( et_pb_image_alt ) !== 'undefined' ?  et_pb_image_alt : '' %>" />

					<p class="description">
END;
esc_html_e( 'If you have a slide image defined, input your HTML ALT text for the image here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text is light or dark. If you have a slide with a dark background, then choose light text. If you have a light background, then use dark text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_video_bg_mp4">
END;
esc_html_e( 'Background Video MP4', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_video_bg_mp4" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_video_bg_mp4 ) !== 'undefined' ?  et_pb_video_bg_mp4 : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Background Video MP4 File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'All videos should be uploaded in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers. Upload the .MP4 version here. <b>Important Note: Video backgrounds are disabled from mobile devices. Instead, your background image will be used. For this reason, you should define both a background image and a background video to ensure best results.</b>', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_video_bg_webm">
END;
esc_html_e( 'Background Video Webm', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_video_bg_webm" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_video_bg_webm ) !== 'undefined' ?  et_pb_video_bg_webm : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload a video', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose a Background Video WEBM File', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Background Video', 'Divi' );
echo <<<END
" data-type="video" />
					<p class="description">
END;
esc_html_e( 'All videos should be uploaded in both .MP4 .WEBM formats to ensure maximum compatibility in all browsers. Upload the .WEBM version here. <b>Important Note: Video backgrounds are disabled from mobile devices. Instead, your background image will be used. For this reason, you should define both a background image and a background video to ensure best results.</b>', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_video_bg_width">
END;
esc_html_e( 'Background Video Width', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_video_bg_width" type="text" class="regular-text" value="<%= typeof( et_pb_video_bg_width ) !== 'undefined' ?  et_pb_video_bg_width : '' %>" />
					<p class="description">
END;
esc_html_e( 'In order for videos to be sized correctly, you must input the exact width (in pixels) of your video here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_video_bg_height">
END;
esc_html_e( 'Background Video Height', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_video_bg_height" type="text" class="regular-text" value="<%= typeof( et_pb_video_bg_height ) !== 'undefined' ?  et_pb_video_bg_height : '' %>" />
					<p class="description">
END;
esc_html_e( 'In order for videos to be sized correctly, you must input the exact height (in pixels) of your video here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_allow_player_pause">
END;
esc_html_e( 'Pause Video', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_allow_player_pause" id="et_pb_allow_player_pause">
						<option value="off"<%= typeof( et_pb_allow_player_pause ) !== 'undefined' && 'off' === et_pb_allow_player_pause ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_allow_player_pause ) !== 'undefined' && 'on' === et_pb_allow_player_pause ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Allow video to be paused by other players when they begin playing', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input your main slide text content here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_blurb-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Blurb Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'The title of your blurb will appear in bold below your blurb image.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url">
END;
esc_html_e( 'Url', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_url" type="text" class="regular-text" value="<%= typeof( et_pb_url ) !== 'undefined' ?  et_pb_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'If you would like to make your blurb a link, input your destination URL here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url_new_window">
END;
esc_html_e( 'Url Opens', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_url_new_window" id="et_pb_url_new_window">
						<option value="off"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'off' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The Same Window', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'on' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The New Tab', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not your link opens in a new window', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_icon">
END;
esc_html_e( 'Use Icon', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_icon" id="et_pb_use_icon" class="et-pb-affects" data-affects="#et_pb_font_icon, #et_pb_use_circle, #et_pb_icon_color, #et_pb_image, #et_pb_alt">
						<option value="off"<%= typeof( et_pb_use_icon ) !== 'undefined' && 'off' === et_pb_use_icon ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_use_icon ) !== 'undefined' && 'on' === et_pb_use_icon ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether icon set below should be used.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_font_icon">
END;
esc_html_e( 'Icon', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
END;
					et_pb_font_icon_list();
echo <<<END
					<input id="et_pb_font_icon" type="text" class="regular-text et-pb-font-icon" value="<%= typeof( et_pb_font_icon ) !== 'undefined' ?  et_pb_font_icon : '' %>" />

					<p class="description">
END;
esc_html_e( 'Choose an icon to display with your blurb.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_icon_color">
END;
esc_html_e( 'Icon Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_icon_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_icon_color ) !== 'undefined' && et_pb_icon_color !== '' ?  et_pb_icon_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can define a custom color for your icon.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_use_circle">
END;
esc_html_e( 'Circle Icon', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_circle" id="et_pb_use_circle" class="et-pb-affects" data-affects="#et_pb_use_circle_border, #et_pb_circle_color">
						<option value="off"<%= typeof( et_pb_use_circle ) !== 'undefined' && 'off' === et_pb_use_circle ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_use_circle ) !== 'undefined' && 'on' === et_pb_use_circle ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether icon set above should display within a circle.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_circle_color">
END;
esc_html_e( 'Circle Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_circle_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_circle_color ) !== 'undefined' && et_pb_circle_color !== '' ?  et_pb_circle_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can define a custom color for the icon circle.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_use_circle_border">
END;
esc_html_e( 'Show Circle Border', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_circle_border" id="et_pb_use_circle_border" class="et-pb-affects" data-affects="#et_pb_circle_border_color">
						<option value="off"<%= typeof( et_pb_use_circle_border ) !== 'undefined' && 'off' === et_pb_use_circle_border ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_use_circle_border ) !== 'undefined' && 'on' === et_pb_use_circle_border ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether if the icon circle border should display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_circle_border_color">
END;
esc_html_e( 'Circle Border Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_circle_border_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="Hex Value" value="<%= typeof( et_pb_circle_border_color ) !== 'undefined' && et_pb_circle_border_color !== '' ?  et_pb_circle_border_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can define a custom color for the icon circle border.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="off">
				<label for="et_pb_image">
END;
esc_html_e( 'Image', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_image" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image ) !== 'undefined' ?  et_pb_image : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an Image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />

					<p class="description">
END;
esc_html_e( 'Upload an image to display at the top of your blurb.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="off">
				<label for="et_pb_alt">
END;
esc_html_e( 'Image Alt Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_alt" type="text" class="regular-text" value="<%= typeof( et_pb_alt ) !== 'undefined' ?  et_pb_alt : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define the HTML ALT text for your image here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_icon_placement">
END;
esc_html_e( 'Image/Icon Placement', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_icon_placement" id="et_pb_icon_placement">
						<option value="top"<%= typeof( et_pb_icon_placement ) !== 'undefined' && 'top' === et_pb_icon_placement ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Top', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END
						<option value="left"<%= typeof( et_pb_icon_placement ) !== 'undefined' && 'left' === et_pb_icon_placement ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
						<option value="left"<%= typeof( et_pb_icon_placement ) !== 'undefined' && 'left' === et_pb_icon_placement ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose where to place the icon.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_animation">
END;
esc_html_e( 'Image/Icon Animation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_animation" id="et_pb_animation">
						<option value="top"<%= typeof( et_pb_animation ) !== 'undefined' && 'top' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Top To Bottom', 'Divi' );
echo <<<END
</option>
						<option value="left"<%= typeof( et_pb_animation ) !== 'undefined' && 'left' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left To Right', 'Divi' );
echo <<<END
</option>
						<option value="right"<%= typeof( et_pb_animation ) !== 'undefined' && 'right' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right To Left', 'Divi' );
echo <<<END
</option>
						<option value="bottom"<%= typeof( et_pb_animation ) !== 'undefined' && 'bottom' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Bottom To Top', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_animation ) !== 'undefined' && 'off' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No Animation', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This controls the direction of the lazy-loading animation.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;

if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'This will control how your blurb text is aligned.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
			<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_testimonial-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Testimonial Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_author">
END;
esc_html_e( 'Author Name', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_author" type="text" class="regular-text" value="<%= typeof( et_pb_author ) !== 'undefined' ?  et_pb_author : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the name of the testimonial author.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_job_title">
END;
esc_html_e( 'Job Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_job_title" type="text" class="regular-text" value="<%= typeof( et_pb_job_title ) !== 'undefined' ?  et_pb_job_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the job title.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_company_name">
END;
esc_html_e( 'Company Name', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_company_name" type="text" class="regular-text" value="<%= typeof( et_pb_company_name ) !== 'undefined' ?  et_pb_company_name : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the name of the company.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url">
END;
esc_html_e( 'Author/Company URL', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_url" type="text" class="regular-text" value="<%= typeof( et_pb_url ) !== 'undefined' ?  et_pb_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the website of the author or leave blank for no link.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url_new_window">
END;
esc_html_e( 'URLs Open', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_url_new_window" id="et_pb_url_new_window">
						<option value="off"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'off' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The Same Window', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'on' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The New Tab', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose whether or not the URL should open in a new window.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_portrait_url">
END;
esc_html_e( 'Portrait Image URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_portrait_url" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_portrait_url ) !== 'undefined' ?  et_pb_portrait_url : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_quote_icon">
END;
esc_html_e( 'Quote Icon', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_quote_icon" id="et_pb_quote_icon">
						<option value="on"<%= typeof( et_pb_quote_icon ) !== 'undefined' && 'on' === et_pb_quote_icon ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Visible', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_quote_icon ) !== 'undefined' && 'off' === et_pb_quote_icon ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Hidden', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose whether or not the quote icon should be visible.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_background_color">
END;
esc_html_e( 'Use Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_background_color" id="et_pb_use_background_color" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="on"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'on' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'off' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether background color setting below should be used or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#f5f5f5' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can define a custom background color for your CTA.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;
if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;
endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'This will adjust the alignment of the module text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_team_member-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Person Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_name">
END;
esc_html_e( 'Name', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_name" type="text" class="regular-text" value="<%= typeof( et_pb_name ) !== 'undefined' ?  et_pb_name : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the name of the person', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_position">
END;
esc_html_e( 'Position', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_position" type="text" class="regular-text" value="<%= typeof( et_pb_position ) !== 'undefined' ?  et_pb_position : '' %>" />

					<p class="description">
END;
esc_html_e( "Input the person's position.", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image_url">
END;
esc_html_e( 'Image URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_image_url" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image_url ) !== 'undefined' ?  et_pb_image_url : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_animation">
END;
esc_html_e( 'Animation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_animation" id="et_pb_animation">
						<option value="off"<%= typeof( et_pb_animation ) !== 'undefined' && 'off' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No Animation', 'Divi' );
echo <<<END
</option>
						<option value="fade_in"<%= typeof( et_pb_animation ) !== 'undefined' && 'fade_in' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Fade In', 'Divi' );
echo <<<END
</option>
						<option value="left"<%= typeof( et_pb_animation ) !== 'undefined' && 'left' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left To Right', 'Divi' );
echo <<<END
</option>
						<option value="right"<%= typeof( et_pb_animation ) !== 'undefined' && 'right' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right To Left', 'Divi' );
echo <<<END
</option>
						<option value="top"<%= typeof( et_pb_animation ) !== 'undefined' && 'top' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Top To Bottom', 'Divi' );
echo <<<END
</option>
						<option value="bottom"<%= typeof( et_pb_animation ) !== 'undefined' && 'bottom' === et_pb_animation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Bottom To Top', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This controls the direction of the lazy-loading animation.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_facebook_url">
END;
esc_html_e( 'Facebook Profile Url', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_facebook_url" type="text" class="regular-text" value="<%= typeof( et_pb_facebook_url ) !== 'undefined' ?  et_pb_facebook_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input Facebook Profile Url.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_twitter_url">
END;
esc_html_e( 'Twitter Profile Url', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_twitter_url" type="text" class="regular-text" value="<%= typeof( et_pb_twitter_url ) !== 'undefined' ?  et_pb_twitter_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input Twitter Profile Url', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_google_url">
END;
esc_html_e( 'Google+ Profile Url', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_google_url" type="text" class="regular-text" value="<%= typeof( et_pb_google_url ) !== 'undefined' ?  et_pb_google_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input Google+ Profile Url', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_linkedin_url">
END;
esc_html_e( 'LinkedIn Profile Url', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_linkedin_url" type="text" class="regular-text" value="<%= typeof( et_pb_linkedin_url ) !== 'undefined' ?  et_pb_linkedin_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input LinkedIn Profile Url', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Description', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_toggle-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Toggle Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'The toggle title will appear above the content and when the toggle is closed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_open">
END;
esc_html_e( 'State', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_open" id="et_pb_open">
						<option value="off"<%= typeof( et_pb_open ) !== 'undefined' && 'off' === et_pb_open ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Close', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_open ) !== 'undefined' && 'on' === et_pb_open ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Open', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose whether or not this toggle should start in an open or closed state.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_cta-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Call To Action Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input your value to action title here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_url">
END;
esc_html_e( 'Button URL', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_url" type="text" class="regular-text" value="<%= typeof( et_pb_button_url ) !== 'undefined' ?  et_pb_button_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the destination URL for your CTA button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_text">
END;
esc_html_e( 'Button Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_text" type="text" class="regular-text" value="<%= typeof( et_pb_button_text ) !== 'undefined' ?  et_pb_button_text : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input your desired button text, or leave blank for no button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_background_color">
END;
esc_html_e( 'Use Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_background_color" id="et_pb_use_background_color" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="on"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'on' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'off' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether background color setting below should be used or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="Hex Value" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can define a custom background color for your CTA.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'This will adjust the alignment of the module text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_signup-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Signup Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_provider">
END;
esc_html_e( 'Service Provider', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_provider" id="et_pb_provider" class="et-pb-affects" data-affects="#et_pb_feedburner_uri, #et_pb_mailchimp_list, #et_pb_aweber_list">
						<option value="mailchimp"<%= typeof( et_pb_provider ) !== 'undefined' && 'mailchimp' === et_pb_provider ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'MailChimp', 'Divi' );
echo <<<END
</option>
						<option value="feedburner"<%= typeof( et_pb_provider ) !== 'undefined' && 'feedburner' === et_pb_provider ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'FeedBurner', 'Divi' );
echo <<<END
</option>
						<option value="aweber"<%= typeof( et_pb_provider ) !== 'undefined' && 'aweber' === et_pb_provider ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Aweber', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose a service provider.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="feedburner">
				<label for="et_pb_feedburner_uri">
END;
esc_html_e( 'Feed Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_feedburner_uri" type="text" class="regular-text" value="<%= typeof( et_pb_feedburner_uri ) !== 'undefined' ?  et_pb_feedburner_uri : '' %>" />

					<p class="description">
END;
_e( sprintf( 'Enter <a href="%1$s" target="_blank">Feed Title</a>.', esc_url( 'http://feedburner.google.com/fb/a/myfeeds' ) ), 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="mailchimp">
				<label for="et_pb_mailchimp_list">
END;
esc_html_e( 'MailChimp lists', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_mailchimp_list" id="et_pb_mailchimp_list">
						<option value="none"<%= typeof( et_pb_mailchimp_list ) !== 'undefined' && 'none' === et_pb_mailchimp_list ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Select the list', 'Divi' );
echo <<<END
</option>
END;

						$et_pb_mailchimp_lists = et_pb_get_mailchimp_lists();

						if ( $et_pb_mailchimp_lists ) {
							foreach ( $et_pb_mailchimp_lists as $et_pb_mailchimp_list_key => $et_pb_mailchimp_list_name ) {
								printf( '<option value="%1$s"%3$s>%2$s</option>',
									esc_attr( $et_pb_mailchimp_list_key ),
									esc_html( $et_pb_mailchimp_list_name ),
									'<%= typeof( et_pb_mailchimp_list ) !== "undefined" && "' . esc_attr( $et_pb_mailchimp_list_key ) . '" === et_pb_mailchimp_list ?  selected="selected" : "" %>'
								);
							}
						}

echo <<<END
					</select>

					<p class="description">
END;
esc_html_e( "Here you can choose MailChimp list to add customers to. If you don't see any lists here, you need to make sure MailChimp API key is set in ePanel and you have at least one list on a MailChimp account. If you added new list, but it doesn't appear here, activate 'Regenerate MailChimp Lists' option in ePanel. Don't forget to disable it once the list has been regenerated.", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends" data-depends_show_if="aweber">
				<label for="et_pb_aweber_list">
END;
esc_html_e( 'Aweber lists', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_aweber_list" id="et_pb_aweber_list">
						<option value="none"<%= typeof( et_pb_aweber_list ) !== 'undefined' && 'none' === et_pb_aweber_list ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Select the list', 'Divi' );
echo <<<END
</option>
END;

						$et_pb_aweber_lists = et_pb_get_aweber_lists();

						if ( $et_pb_aweber_lists ) {
							foreach ( $et_pb_aweber_lists as $et_pb_aweber_list_key => $et_pb_aweber_list_name ) {
								printf( '<option value="%1$s"%3$s>%2$s</option>',
									esc_attr( $et_pb_aweber_list_key ),
									esc_html( $et_pb_aweber_list_name ),
									'<%= typeof( et_pb_aweber_list ) !== "undefined" && "' . esc_attr( $et_pb_aweber_list_key ) . '" === et_pb_aweber_list ?  selected="selected" : "" %>'
								);
							}
						}

echo <<<END
					</select>

					<p class="description">
END;
esc_html_e( "Here you can choose Aweber list to add customers to. If you don't see any lists here, you need to make sure Aweber is set up properly in ePanel and you have at least one list on a Aweber account. If you added new list, but it doesn't appear here, activate 'Regenerate Aweber Lists' option in ePanel. Don't forget to disable it once the list has been regenerated.", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Choose a title of your signup box.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_text">
END;
esc_html_e( 'Button Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_text" type="text" class="regular-text" value="<%= typeof( et_pb_button_text ) !== 'undefined' ?  et_pb_button_text : '' %>" />

					<p class="description">
END;
esc_html_e( 'Here you can change the text used for the signup button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_background_color">
END;
esc_html_e( 'Use Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_background_color" id="et_pb_use_background_color" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="on"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'on' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'off' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether background color setting below should be used or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Define a custom background color for your module, or leave blank to use the default color.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can adjust the alignment of your text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_login-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Login Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Choose a title of your login box.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_current_page_redirect">
END;
esc_html_e( 'Redirect To The Current Page', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_current_page_redirect" id="et_pb_current_page_redirect">
						<option value="off"<%= typeof( et_pb_current_page_redirect ) !== 'undefined' && 'off' === et_pb_current_page_redirect ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_current_page_redirect ) !== 'undefined' && 'on' === et_pb_current_page_redirect ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether the user should be redirected to the current page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_background_color">
END;
esc_html_e( 'Use Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_use_background_color" id="et_pb_use_background_color" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="on"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'on' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'off' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether background color setting below should be used or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Define a custom background color for your module, or leave blank to use the default color.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
						<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'Here you can adjust the alignment of your text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_audio-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Audio Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_audio">
END;
esc_html_e( 'Audio', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_audio" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_audio ) !== 'undefined' ?  et_pb_audio : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an audio file', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Audio file', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Audio for the module', 'Divi' );
echo <<<END
" data-type="audio" />

					<p class="description">
END;
esc_html_e( 'Define the audio file for use in the module. To remove an audio file from the module, simply delete the URL from the settings field.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define a title.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_artist_name">
END;
esc_html_e( 'Artist Name', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_artist_name" type="text" class="regular-text" value="<%= typeof( et_pb_artist_name ) !== 'undefined' ?  et_pb_artist_name : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define an artist name.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_album_name">
END;
esc_html_e( 'Album name', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_album_name" type="text" class="regular-text" value="<%= typeof( et_pb_album_name ) !== 'undefined' ?  et_pb_album_name : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define an album name.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_image_url">
END;
esc_html_e( 'Cover Art Image URL', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_image_url" type="text" class="regular-text et-pb-upload-field" value="<%= typeof( et_pb_image_url ) !== 'undefined' ?  et_pb_image_url : '' %>" />
					<input type='button' class='button button-upload et-pb-upload-button' value='
END;
esc_html_e( 'Upload an image', 'Divi' );
echo <<<END
' data-choose="
END;
esc_html_e( 'Choose an Image', 'Divi' );
echo <<<END
" data-update="
END;
esc_html_e( 'Set As Image', 'Divi' );
echo <<<END
" data-type="image" />
					<p class="description">
END;
esc_html_e( 'Upload your desired image, or type in the URL to the image you would like to display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />

					<p class="description">
END;
esc_html_e( 'Define a custom background color for your module, or leave blank to use the default color.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_contact_form-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Contact Form Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_captcha">
END;
esc_html_e( 'Captcha', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_captcha" id="et_pb_captcha">
						<option value="on"<%= typeof( et_pb_captcha ) !== 'undefined' && 'on' === et_pb_captcha ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Display Captcha', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_captcha ) !== 'undefined' && 'off' === et_pb_captcha ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Display Captcha", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the captcha on or off using this option.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_email">
END;
esc_html_e( 'Email', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_email" type="text" class="regular-text" value="<%= typeof( et_pb_email ) !== 'undefined' ?  et_pb_email : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the email address where messages should be sent.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define a title for your contact form.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_divider-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Divider Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_color">
END;
esc_html_e( 'Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_color ) !== 'undefined' && et_pb_color !== '' ?  et_pb_color : '#ffffff' %>" />

					<p class="description">
END;
esc_html_e( 'This will adjust the color of the 1px divider line.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_divider">
END;
esc_html_e( 'Visibility', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_divider" id="et_pb_show_divider">
						<option value="off"<%= typeof( et_pb_show_divider ) !== 'undefined' && 'off' === et_pb_show_divider ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Divider", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_show_divider ) !== 'undefined' && 'on' === et_pb_show_divider ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Divider', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This settings turns on and off the 1px divider line, but does not affect the divider height.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_height">
END;
esc_html_e( 'Height', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_height" type="text" class="regular-text" value="<%= typeof( et_pb_height ) !== 'undefined' ?  et_pb_height : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define how much space should be added below the divider (in pixels).', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_blog-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Blog Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_fullwidth">
END;
esc_html_e( 'Layout', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth" class="et-pb-affects" data-affects="#et_pb_background_layout">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Fullwidth', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Grid', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Toggle between the various blog layout types.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Posts Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '10' %>" />

					<p class="description">
END;
esc_html_e( 'Choose how much posts you would like to display per page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_include_categories">
END;
esc_html_e( 'Include Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
				<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>
END;

					$cats_array = get_categories( 'hide_empty=0' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->cat_ID ),
							esc_html( $categs->cat_name ),
							'<%= _.contains( et_pb_include_categories_temp, "' . $categs->cat_ID . '" ) ? checked="checked" : "" %>'
						);
					}
echo <<<END

					<p class="description">
END;
esc_html_e( 'Choose which categories you would like to include in the feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_meta_date">
END;
esc_html_e( 'Meta Date Format', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_meta_date" type="text" class="regular-text" value="<%= typeof( et_pb_meta_date ) !== 'undefined' ?  et_pb_meta_date : 'M j, Y' %>" />

					<p class="description">
END;
esc_html_e( 'If you would like to adjust the date format, input the appropriate PHP date format here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_thumbnail">
END;
esc_html_e( 'Featured Image', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_thumbnail" id="et_pb_show_thumbnail">
						<option value="on"<%= typeof( et_pb_show_thumbnail ) !== 'undefined' && 'on' === et_pb_show_thumbnail ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Featured Image', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_thumbnail ) !== 'undefined' && 'off' === et_pb_show_thumbnail ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Featured Image", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'This will turn thumbnails on and off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_content">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_content" id="et_pb_show_content" class="et-pb-affects" data-affects="#et_pb_show_more">
						<option value="off"<%= typeof( et_pb_show_content ) !== 'undefined' && 'off' === et_pb_show_content ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Excerpt', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_show_content ) !== 'undefined' && 'on' === et_pb_show_content ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Content', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Showing the full content will not truncate your posts on the index page. Showing the excerpt will only display your excerpt text.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option" data-depends_show_if="off">
				<label for="et_pb_show_more">
END;
esc_html_e( 'Read More Button', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_more" id="et_pb_show_more">
						<option value="off"<%= typeof( et_pb_show_more ) !== 'undefined' && 'off' === et_pb_show_more ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_show_more ) !== 'undefined' && 'on' === et_pb_show_more ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can define whether to show "read more" link after the excerpts or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_author">
END;
esc_html_e( 'Author', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_author" id="et_pb_show_author">
						<option value="on"<%= typeof( et_pb_show_author ) !== 'undefined' && 'on' === et_pb_show_author ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Author', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_author ) !== 'undefined' && 'off' === et_pb_show_author ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Author", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn on or off the author link.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_date">
END;
esc_html_e( 'Date', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_date" id="et_pb_show_date">
						<option value="on"<%= typeof( et_pb_show_date ) !== 'undefined' && 'on' === et_pb_show_date ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Date', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_date ) !== 'undefined' && 'off' === et_pb_show_date ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Date", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the date on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_categories">
END;
esc_html_e( 'Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_categories" id="et_pb_show_categories">
						<option value="on"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'on' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Categories', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'off' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Categories", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the category links on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Pagination', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Pagination', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Pagination", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn pagination on and off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_offset_number">
END;
esc_html_e( 'Offset Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_offset_number" type="text" class="regular-text" value="<%= typeof( et_pb_offset_number ) !== 'undefined' ?  et_pb_offset_number : '0' %>" />

					<p class="description">
END;
esc_html_e( 'Choose how many posts you would like to offset by', 'Divi' );
echo <<<END
.</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_portfolio-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Portfolio Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_fullwidth">
END;
esc_html_e( 'Layout', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Fullwidth', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Grid', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose your desired portfolio layout style.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Posts Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '10' %>" />

					<p class="description">
END;
esc_html_e( 'Define the number of projects that should be displayed per page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_include_categories">
END;
esc_html_e( 'Include Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
				<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>
END;

					$cats_array = get_terms( 'project_category' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->term_id ),
							esc_html( $categs->name ),
							'<%= _.contains( et_pb_include_categories_temp, "' . $categs->term_id . '" ) ? checked="checked" : "" %>'
						);
					}
echo <<<END

					<p class="description">
END;
esc_html_e( 'Select the categories that you would like to include in the feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_title" id="et_pb_show_title">
						<option value="on"<%= typeof( et_pb_show_title ) !== 'undefined' && 'on' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Title', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_title ) !== 'undefined' && 'off' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Title", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn project titles on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_categories">
END;
esc_html_e( 'Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_categories" id="et_pb_show_categories">
						<option value="on"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'on' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Categories', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'off' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Categories", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the category links on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Pagination', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Pagination', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Pagination", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Enable or disable pagination for this feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_filterable_portfolio-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Filterable Portfolio Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_fullwidth">
END;
esc_html_e( 'Layout', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Fullwidth', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Grid', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose your desired portfolio layout style.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Posts Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '10' %>" />

					<p class="description">
END;
esc_html_e( 'Define the number of projects that should be displayed per page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_include_categories">
END;
esc_html_e( 'Include Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
				<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>
END;

					$cats_array = get_terms( 'project_category' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->term_id ),
							esc_html( $categs->name ),
							'<%= _.contains( et_pb_include_categories_temp, "' . $categs->term_id . '" ) ? checked="checked" : "" %>'
						);
					}
echo <<<END

					<p class="description">
END;
esc_html_e( 'Select the categories that you would like to include in the feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_title" id="et_pb_show_title">
						<option value="on"<%= typeof( et_pb_show_title ) !== 'undefined' && 'on' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Title', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_title ) !== 'undefined' && 'off' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Title", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn project titles on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_categories">
END;
esc_html_e( 'Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_categories" id="et_pb_show_categories">
						<option value="on"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'on' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Categories', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_categories ) !== 'undefined' && 'off' === et_pb_show_categories ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Categories", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the category links on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_pagination">
END;
esc_html_e( 'Pagination', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_pagination" id="et_pb_show_pagination">
						<option value="on"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'on' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Pagination', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_pagination ) !== 'undefined' && 'off' === et_pb_show_pagination ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Pagination", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Enable or disable pagination for this feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

<script type="text/template" id="et-builder-et_pb_fullwidth_portfolio-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Fullwidth Portfolio Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
		<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Portfolio Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />
					<p class="description">
END;
esc_html_e( 'Title displayed above the portfolio.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_fullwidth">
END;
esc_html_e( 'Layout', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_fullwidth" id="et_pb_fullwidth">
						<option value="on"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'on' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Carousel', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_fullwidth ) !== 'undefined' && 'off' === et_pb_fullwidth ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Grid', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose your desired portfolio layout style.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_include_categories">
END;
esc_html_e( 'Include Categories', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
				<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>
END;

					$cats_array = get_terms( 'project_category' );
					foreach ( $cats_array as $categs ) {
						printf( '<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',
							esc_attr( $categs->term_id ),
							esc_html( $categs->name ),
							'<%= _.contains( et_pb_include_categories_temp, "' . $categs->term_id . '" ) ? checked="checked" : "" %>'
						);
					}
echo <<<END

					<p class="description">
END;
esc_html_e( 'Select the categories that you would like to include in the feed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Posts Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '' %>" />

					<p class="description">
END;
esc_html_e( 'Control how many projects are displayed. Leave blank or use 0 to not limit the amount.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_title" id="et_pb_show_title">
						<option value="on"<%= typeof( et_pb_show_title ) !== 'undefined' && 'on' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Title', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_title ) !== 'undefined' && 'off' === et_pb_show_title ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Title", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn project titles on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_show_date">
END;
esc_html_e( 'Date', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_show_date" id="et_pb_show_date">
						<option value="on"<%= typeof( et_pb_show_date ) !== 'undefined' && 'on' === et_pb_show_date ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Show Date', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_show_date ) !== 'undefined' && 'off' === et_pb_show_date ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Show Date", 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Turn the date display on or off.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_auto">
END;
esc_html_e( 'Automatic Carousel Rotation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_auto" id="et_pb_auto" class="et-pb-affects" data-affects="#et_pb_auto_speed">
						<option value="off"<%= typeof( et_pb_auto ) !== 'undefined' && 'off' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Disabled', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_auto ) !== 'undefined' && 'on' === et_pb_auto ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Enabled', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'If you the carousel layout option is chosen and you would like the carousel to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_auto_speed">
END;
esc_html_e( 'Automatic Carousel Rotation Speed (in ms)', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_auto_speed" type="text" class="regular-text" value="<%= typeof( et_pb_auto_speed ) !== 'undefined' ?  et_pb_auto_speed : '' %>" />
					<p class="description">
END;
esc_html_e( "Here you can designate how fast the carousel rotates, if 'Automatic Carousel Rotation' option is enabled above. The higher the number the longer the pause between each rotation. (Ex. 1000 = 1 sec)", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_shop-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Shop Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_type">
END;
esc_html_e( 'Type', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_type" id="et_pb_type">
						<option value="recent"<%= typeof( et_pb_type ) !== 'undefined' && 'recent' === et_pb_type ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Recent Products', 'Divi' );
echo <<<END
</option>
						<option value="featured"<%= typeof( et_pb_type ) !== 'undefined' && 'featured' === et_pb_type ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Featured Products', 'Divi' );
echo <<<END
</option>
						<option value="sale"<%= typeof( et_pb_type ) !== 'undefined' && 'sale' === et_pb_type ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sale Products', 'Divi' );
echo <<<END
</option>
						<option value="best_selling"<%= typeof( et_pb_type ) !== 'undefined' && 'best_selling' === et_pb_type ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Best Selling Products', 'Divi' );
echo <<<END
</option>
						<option value="top_rated"<%= typeof( et_pb_type ) !== 'undefined' && 'top_rated' === et_pb_type ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Top Rated Products', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose which type of products you would like to display.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_posts_number">
END;
esc_html_e( 'Posts Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_posts_number" type="text" class="regular-text" value="<%= typeof( et_pb_posts_number ) !== 'undefined' ?  et_pb_posts_number : '12' %>" />

					<p class="description">
END;
esc_html_e( 'Control how many products are displayed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_columns">
END;
esc_html_e( 'Columns Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_columns" id="et_pb_columns">
						<option value="4"<%= typeof( et_pb_columns ) !== 'undefined' && '4' === et_pb_columns ?  ' selected="selected"' : '' %>>4</option>
						<option value="3"<%= typeof( et_pb_columns ) !== 'undefined' && '3' === et_pb_columns ?  ' selected="selected"' : '' %>>3</option>
						<option value="2"<%= typeof( et_pb_columns ) !== 'undefined' && '2' === et_pb_columns ?  ' selected="selected"' : '' %>>2</option>
						<option value="1"<%= typeof( et_pb_columns ) !== 'undefined' && '1' === et_pb_columns ?  ' selected="selected"' : '' %>>1</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose how many columns to display. 4 columns should be used for a 1 column row. 2 columns should be used for a 1/2 row column. 1 column should be used for a 1/4 row column.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_orderby">
END;
esc_html_e( 'Order By', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_orderby" id="et_pb_orderby">
						<option value="menu_order"<%= typeof( et_pb_orderby ) !== 'undefined' && 'menu_order' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Default Sorting', 'Divi' );
echo <<<END
</option>
						<option value="popularity"<%= typeof( et_pb_orderby ) !== 'undefined' && 'popularity' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sort By Popularity', 'Divi' );
echo <<<END
</option>
						<option value="rating"<%= typeof( et_pb_orderby ) !== 'undefined' && 'rating' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sort By Rating', 'Divi' );
echo <<<END
</option>
						<option value="date"<%= typeof( et_pb_orderby ) !== 'undefined' && 'date' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sort By Date', 'Divi' );
echo <<<END
</option>
						<option value="price"<%= typeof( et_pb_orderby ) !== 'undefined' && 'price' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sort By Price: Low To High', 'Divi' );
echo <<<END
</option>
						<option value="price-desc"<%= typeof( et_pb_orderby ) !== 'undefined' && 'price-desc' === et_pb_orderby ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Sort By Price: High To Low', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose how your products should be ordered.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_pricing_tables-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Pricing Tables Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_pricing_table">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Pricing Table', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_pricing_table-title">
		<%= typeof( et_pb_title ) !== 'undefined' && typeof( et_pb_title ) === 'string' ?  et_pb_title : '
END;
esc_html_e( 'New Pricing Table', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_pricing_table">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Pricing Table Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_featured">
END;
esc_html_e( 'Featured', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_featured" id="et_pb_featured">
						<option value="off"<%= typeof( et_pb__featured ) !== 'undefined' && 'off' === et_pb_featured ?  ' selected="selected"' : '' %>>
END;
esc_html_e( "Don't Make This Table Featured", 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_featured ) !== 'undefined' && 'on' === et_pb_featured ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Make This Table Featured', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Featuring a table will make it stand out from the rest.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define a title for the pricing table.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_subtitle">
END;
esc_html_e( 'Subtitle', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_subtitle" type="text" class="regular-text" value="<%= typeof( et_pb_subtitle ) !== 'undefined' ?  et_pb_subtitle : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define a sub title for the table if desired.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_currency">
END;
esc_html_e( 'Currency', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_currency" type="text" class="regular-text" value="<%= typeof( et_pb_currency ) !== 'undefined' ?  et_pb_currency : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input your desired currency symbol here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_per">
END;
esc_html_e( 'Per', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_per" type="text" class="regular-text" value="<%= typeof( et_pb_per ) !== 'undefined' ?  et_pb_per : '' %>" />

					<p class="description">
END;
esc_html_e( 'If your pricing is subscription based, input the subscription payment cycle here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_sum">
END;
esc_html_e( 'Price', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_sum" type="text" class="regular-text" value="<%= typeof( et_pb_sum ) !== 'undefined' ?  et_pb_sum : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the value of the product here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_url">
END;
esc_html_e( 'Button URL', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_url" type="text" class="regular-text" value="<%= typeof( et_pb_button_url ) !== 'undefined' ?  et_pb_button_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input the destination URL for the signup button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_button_text">
END;
esc_html_e( 'Button Text', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_button_text" type="text" class="regular-text" value="<%= typeof( et_pb_button_text ) !== 'undefined' ?  et_pb_button_text : '' %>" />

					<p class="description">
END;
esc_html_e( 'Adjust the text used from the signup button.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input a list of features that are/are not included in the product. Separate items on a new line, and begin with either a + or - symbol: ', 'Divi' );
echo <<<END
<br/>
					+
END;
echo ' ';
esc_html_e( 'Included option', 'Divi' );
echo <<<END
<br/>
					-
END;
echo ' ';
esc_html_e( 'Excluded option', 'Divi' );
echo <<<END
<br/>
					</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_counters-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Bar Counters Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_counter">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Bar Counter', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#dddddd' %>" />
					<p class="description">
END;
esc_html_e( 'This will adjust the color of the empty space in the bar (currently gray).', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_bar_bg_color">
END;
esc_html_e( 'Bar Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_bar_bg_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_bar_bg_color ) !== 'undefined' && et_pb_bar_bg_color !== '' ?  et_pb_bar_bg_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the fill color for the bar.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_counter-title">
		<%= typeof( et_pb_content_new ) !== 'undefined' && typeof( et_pb_content_new ) === 'string' ?  et_pb_content_new : '
END;
esc_html_e( 'New Bar Counter', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_counter">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Bar Counter Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_content_new" type="text" class="regular-text" value="<%= typeof( et_pb_content_new ) !== 'undefined' ?  et_pb_content_new : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input a title for your bar.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_percent">
END;
esc_html_e( 'Percent', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_percent" type="text" class="regular-text" value="<%= typeof( et_pb_percent ) !== 'undefined' ?  et_pb_percent : '' %>" />

					<p class="description">
END;
esc_html_e( 'Define a percentage for this bar.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_accordion-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Accordion Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_accordion_item">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Item', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the current tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_accordion_item-title">
		<%= typeof( et_pb_title ) !== 'undefined' && typeof( et_pb_title ) === 'string' ?  et_pb_title : '
END;
esc_html_e( 'Add New Item', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_accordion_item">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Accordion Item Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'The toggle title will appear above the content and when the toggle is closed.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the current tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_countdown_timer-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Countdown Timer Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Countdown Timer Title', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' && et_pb_title !== '' ?  et_pb_title : '' %>" />
					<p class="description">
END;
esc_html_e( 'This is the title displayed for the countdown timer.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_date_time">
END;
esc_html_e( 'Countdown To', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_date_time" type="text" class="regular-text et-pb-date-time-picker" value="<%= typeof( et_pb_date_time ) !== 'undefined' && et_pb_date_time !== '' ?  et_pb_date_time : '' %>" />
					<p class="description">
END;
esc_html_e( 'This is the date the countdown timer is counting down to.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_use_background_color">
END;
esc_html_e( 'Use Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<select name="et_pb_use_background_color" id="et_pb_use_background_color" class="et-pb-affects" data-affects="#et_pb_background_color">
						<option value="on"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'on' === et_pb_use_background_color ? ' selected="selected"' : '' %>>
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_use_background_color ) !== 'undefined' && 'off' === et_pb_use_background_color ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</option>
					</select>
					<p class="description">
END;
esc_html_e( 'Here you can choose whether background color setting below should be used or not.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-depends">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />
					<p class="description">
END;
esc_html_e( 'Here you can define a custom background color for your countdown timer.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_map_pin-title">
		<%= typeof( et_pb_title ) !== 'undefined' && typeof( et_pb_title ) === 'string' ?  et_pb_title : '
END;
esc_html_e( 'New Pin', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_map_pin">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Pin Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />
					<p class="description">
END;
esc_html_e( 'The title will be used within the tab button for this tab.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_pin_address">
END;
esc_html_e( 'Map Pin Address', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_pin_address" type="text" class="et_pb_pin_address regular-text" value="<%= typeof( et_pb_pin_address ) !== 'undefined' ?  et_pb_pin_address : '' %>" />  <a href="#" class="et_pb_find_address button">
END;
esc_html_e( 'Find', 'Divi' );
echo <<<END
</a>
					<p class="description">
END;
esc_html_e( 'Enter an address for this map pin, and the address will be geocoded and displayed on the map below.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<input class="et_pb_zoom_level" type="hidden" value="18" />
				<input id="et_pb_pin_address_lat" class="et_pb_pin_address_lat" type="hidden" class="regular-text" value="<%= typeof( et_pb_pin_address_lat ) !== 'undefined' ?  et_pb_pin_address_lat : '' %>" />
				<input id="et_pb_pin_address_lng" class="et_pb_pin_address_lng" type="hidden" class="regular-text" value="<%= typeof( et_pb_pin_address_lng ) !== 'undefined' ?  et_pb_pin_address_lng : '' %>" />
				<div id="et_pb_map_center_map" class="et-pb-map et_pb_map_center_map"></div>
			</div>

			<div class="et-pb-option et-pb-option-main-content">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the infobox for the pin.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_map-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Map Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_map_pin">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Pin', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the infobox for the pin.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_address">
END;
esc_html_e( 'Map Center Address', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_address" class="et_pb_address" type="text" class="regular-text" value="<%= typeof( et_pb_address ) !== 'undefined' ?  et_pb_address : '' %>" /> <a href="#" class="et_pb_find_address button">
END;
esc_html_e( 'Find', 'Divi' );
echo <<<END
</a>
					<p class="description">
END;
esc_html_e( 'Enter an address for the map center point, and the address will be geocoded and displayed on the map below.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<input id="et_pb_zoom_level" type="hidden" class="et_pb_zoom_level" value="<%= typeof( et_pb_zoom_level ) !== 'undefined' ?  et_pb_zoom_level : '18' %>" />
				<input id="et_pb_address_lat" class="et_pb_address_lat" type="hidden" value="<%= typeof( et_pb_address_lat ) !== 'undefined' ?  et_pb_address_lat : '' %>" />
				<input id="et_pb_address_lng" class="et_pb_address_lng" type="hidden"  value="<%= typeof( et_pb_address_lng ) !== 'undefined' ?  et_pb_address_lng : '' %>" />
				<div id="et_pb_map_center_map" class="et-pb-map et_pb_map_center_map"></div>
			</div>

			<div class="et-pb-option">
				<label for="et_pb_mouse_wheel">
END;
esc_html_e( 'Mouse Wheel Zoom', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_mouse_wheel" id="et_pb_mouse_wheel">
						<option value="on"<%= typeof( et_pb_mouse_wheel ) !== 'undefined' && 'on' === et_pb_mouse_wheel ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_mouse_wheel ) !== 'undefined' && 'off' === et_pb_mouse_wheel ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether the zoom level will be controlled by mouse wheel or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_fullwidth_map-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Map Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_map_pin">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add New Pin', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Here you can define the content that will be placed within the infobox for the pin.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_address">
END;
esc_html_e( 'Map Center Address', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_address" class="et_pb_address" type="text" class="regular-text" value="<%= typeof( et_pb_address ) !== 'undefined' ?  et_pb_address : '' %>" /> <a href="#" class="et_pb_find_address button">
END;
esc_html_e( 'Find', 'Divi' );
echo <<<END
</a>
					<p class="description">
END;
esc_html_e( 'Enter an address for the map center point, and the address will be geocoded and displayed on the map below.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<input id="et_pb_zoom_level" type="hidden" class="et_pb_zoom_level" value="<%= typeof( et_pb_zoom_level ) !== 'undefined' ?  et_pb_zoom_level : '18' %>" />
				<input id="et_pb_address_lat" class="et_pb_address_lat" type="hidden" value="<%= typeof( et_pb_address_lat ) !== 'undefined' ?  et_pb_address_lat : '' %>" />
				<input id="et_pb_address_lng" class="et_pb_address_lng" type="hidden"  value="<%= typeof( et_pb_address_lng ) !== 'undefined' ?  et_pb_address_lng : '' %>" />
				<div id="et_pb_map_center_map" class="et-pb-map et_pb_map_center_map"></div>
			</div>

			<div class="et-pb-option">
				<label for="et_pb_mouse_wheel">
END;
esc_html_e( 'Mouse Wheel Zoom', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_mouse_wheel" id="et_pb_mouse_wheel">
						<option value="on"<%= typeof( et_pb_mouse_wheel ) !== 'undefined' && 'on' === et_pb_mouse_wheel ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_mouse_wheel ) !== 'undefined' && 'off' === et_pb_mouse_wheel ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether the zoom level will be controlled by mouse wheel or not.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_circle_counter-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Circle Counter Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input a title for the circle counter.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_number">
END;
esc_html_e( 'Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_number" type="text" class="regular-text et-validate-number" maxlength="3" value="<%= typeof( et_pb_number ) !== 'undefined' ?  et_pb_number : '' %>" />

					<p class="description">
END;
esc_html_e( "Define a number for the circle counter. (Don't include the percentage sign, use the option below.). <strong>Note: You can use only natural numbers from 0 to 100</strong>", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_percent_sign">
END;
esc_html_e( 'Percent Sign', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_percent_sign" id="et_pb_percent_sign">
						<option value="on"<%= typeof( et_pb_percent_sign ) !== 'undefined' && 'on' === et_pb_percent_sign ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_percent_sign ) !== 'undefined' && 'off' === et_pb_percent_sign ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether the percent sign should be added after the number set above.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_bar_bg_color">
END;
esc_html_e( 'Bar Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_bar_bg_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_bar_bg_color ) !== 'undefined' && et_pb_bar_bg_color !== '' ?  et_pb_bar_bg_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the fill color for the bar.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_number_counter-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Number Counter Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">

			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />

					<p class="description">
END;
esc_html_e( 'Input a title for the counter.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_number">
END;
esc_html_e( 'Number', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_number" type="text" class="regular-text" value="<%= typeof( et_pb_number ) !== 'undefined' ?  et_pb_number : '' %>" />

					<p class="description">
END;
esc_html_e( "Define a number for the counter. (Don't include the percentage sign, use the option below.)", 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_percent_sign">
END;
esc_html_e( 'Percent Sign', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_percent_sign" id="et_pb_percent_sign">
						<option value="on"<%= typeof( et_pb_percent_sign ) !== 'undefined' && 'on' === et_pb_percent_sign ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
						<option value="off"<%= typeof( et_pb_percent_sign ) !== 'undefined' && 'off' === et_pb_percent_sign ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether the percent sign should be added after the number set above.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_counter_color">
END;
esc_html_e( 'Counter Text Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_counter_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_counter_color ) !== 'undefined' && et_pb_counter_color !== '' ?  et_pb_counter_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the fill color for the bar.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your title text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_sidebar-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Sidebar Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_orientation">
END;
esc_html_e( 'Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_orientation" id="et_pb_orientation">
						<option value="left"<%= typeof( et_pb_orientation ) !== 'undefined' && 'left' === et_pb_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
						<option value="right"<%= typeof( et_pb_orientation ) !== 'undefined' && 'right' === et_pb_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose which side of the page your sidebar will be on. This setting controls text orientation and border position.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_area">
END;
esc_html_e( 'Widget Area', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
END;

				global $wp_registered_sidebars;
				$et_pb_widgets = get_theme_mod( 'et_pb_widgets' );

				if ( $wp_registered_sidebars && is_array( $wp_registered_sidebars ) ) { ?>
					<select name="et_pb_area" id="et_pb_area">
					<?php foreach ( $wp_registered_sidebars as $id => $options ) {
						printf( '<option value="%1$s"%2$s>%3$s</option>',
							esc_attr( $id ),
							'<%= typeof( et_pb_area ) !== "undefined" && "' . $id . '" === et_pb_area ?  " selected=\'selected\'" : "" %>',
							esc_html( $options['name'] )
						);
					} ?>
					</select>
				<?php } ?>

					<p class="description"><?php esc_html_e( 'Select a widget-area that you would like to display. You can create new widget areas within the Appearances > Widgets tab.', 'Divi' ); ?></p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
<?php
echo <<<END
			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_fullwidth_header-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Fullwidth Header Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_title">
END;
esc_html_e( 'Title', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_title" type="text" class="regular-text" value="<%= typeof( et_pb_title ) !== 'undefined' ?  et_pb_title : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter your page title here.', 'Divi' );
echo <<<END
</p>
				</div>
			</div>

			<div class="et-pb-option">
				<label for="et_pb_subhead">
END;
esc_html_e( 'Subheading Text', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_subhead" type="text" class="regular-text" value="<%= typeof( et_pb_subhead ) !== 'undefined' ?  et_pb_subhead : '' %>" />
					<p class="description">
END;
esc_html_e( 'If you would like to use a subhead, add it here. Your subhead will appear below your title in a small font.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
						<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'This controls the how your text is aligned within the module.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-et_pb_fullwidth_menu-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Fullwidth Menu Module Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option">
				<label for="et_pb_menu_id">
END;
esc_html_e( 'Menu', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<select name="et_pb_menu_id" id="et_pb_menu_id">
						<option value="none"<%= typeof( et_pb_menu_id ) !== 'undefined' && 'none' === et_pb_menu_id ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Select a menu', 'Divi' );
echo <<<END
</option>
END;
					$nav_menus = wp_get_nav_menus( array('orderby' => 'name') );
					foreach ( (array) $nav_menus as $_nav_menu ) {
						printf( '<option value="%1$s"%2$s>%3$s</option>',
							esc_attr( $_nav_menu->term_id ),
							'<%= typeof( et_pb_menu_id ) !== "undefined" && "' . esc_attr( $_nav_menu->term_id ) . '" === et_pb_menu_id ?  selected="selected" : "" %>',
							esc_html( $_nav_menu->name )
						);
					}
echo <<<END
					</select>
END;
					printf( '<p class="description">%2$s. <a href="%1$s" target="_blank">%3$s</a>.</p>',
						esc_url( admin_url( 'nav-menus.php' ) ),
						esc_html__( 'Select a menu that should be used in the module', 'Divi' ),
						esc_html__( 'Click here to create new menu', 'Divi' )
					);
echo <<<END

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_color">
END;
esc_html_e( 'Background Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_background_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_background_color ) !== 'undefined' && et_pb_background_color !== '' ?  et_pb_background_color : '#ffffff' %>" />
					<p class="description">
END;
esc_html_e( 'Use the color picker to choose a background color for this module.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose the value of your text. If you are working with a dark background, then your text should be set to light. If you are working with a light background, then your text should be dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_text_orientation">
END;
esc_html_e( 'Text Orientation', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_text_orientation" id="et_pb_text_orientation">
END;
if ( ! is_rtl() ) :

echo <<<END
<option value="left"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'left' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Left', 'Divi' );
echo <<<END
</option>
END;

else :

echo <<<END
<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>
END;

endif;

echo <<<END
						<option value="center"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'center' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Center', 'Divi' );
echo <<<END
</option>
END;

if ( ! is_rtl() ) :

echo <<<END

						<option value="right"<%= typeof( et_pb_text_orientation ) !== 'undefined' && 'right' === et_pb_text_orientation ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Right', 'Divi' );
echo <<<END
</option>

END;

endif;

echo <<<END
					</select>
					<p class="description">
END;
esc_html_e( 'This controls the how your text is aligned within the module.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_submenu_direction">
END;
esc_html_e( 'Sub-Menus Open', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_submenu_direction" id="et_pb_submenu_direction">
						<option value="downwards"<%= typeof( et_pb_submenu_direction ) !== 'undefined' && 'downwards' === et_pb_submenu_direction ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Downwards', 'Divi' );
echo <<<END
</option>
						<option value="upwards"<%= typeof( et_pb_submenu_direction ) !== 'undefined' && 'upwards' === et_pb_submenu_direction ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Upwards', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose the direction that your sub-menus will open. You can choose to have them open downwards or upwards.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<!-- et_pb_social_media_follow -->
	<script type="text/template" id="et-builder-et_pb_social_media_follow-module-template">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Social Media Follow Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">
			<div class="et-pb-option-advanced-module-settings" data-module_type="et_pb_social_media_follow_network">
				<ul class="et-pb-sortable-options">
				</ul>
				<a href="#" class="et-pb-add-sortable-option"><span>
END;
esc_html_e( 'Add Social Network', 'Divi' );
echo <<<END
</span></a>
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_link_shape">
END;
esc_html_e( 'Link Shape', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_link_shape" id="et_pb_link_shape">
						<option value="rounded_rectangle"<%= typeof( et_pb_link_shape ) !== 'undefined' && 'rounded_rectangle' === et_pb_link_shape ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Rounded Rectangle', 'Divi' );
echo <<<END
</option>
						<option value="circle"<%= typeof( et_pb_link_shape ) !== 'undefined' && 'circle' === et_pb_link_shape ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Circle', 'Divi' );
echo <<<END
</option>
					</select>
					<p class="description">
END;
esc_html_e( 'Here you can choose the shape of your social network icons.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_background_layout">
END;
esc_html_e( 'Text Color', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_background_layout" id="et_pb_background_layout">
						<option value="light"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'light' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Dark', 'Divi' );
echo <<<END
</option>
						<option value="dark"<%= typeof( et_pb_background_layout ) !== 'undefined' && 'dark' === et_pb_background_layout ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Light', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option et-pb-option-main-content et-pb-option-advanced-module">
				<label for="et_pb_content_new">
END;
esc_html_e( 'Content', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<div id="et_pb_content_new"><%= typeof( et_pb_content_new )!== 'undefined' ? et_pb_content_new : '' %></div>
					<p class="description">
END;
esc_html_e( 'Input the main text content for your module here.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url_new_window">
END;
esc_html_e( 'Url Opens', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_url_new_window" id="et_pb_url_new_window">
						<option value="off"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'off' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The Same Window', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_url_new_window ) !== 'undefined' && 'on' === et_pb_url_new_window ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'In The New Tab', 'Divi' );
echo <<<END
</option>
					</select>
					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not your link opens in a new window', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_follow_button">
END;
esc_html_e( 'Follow Button', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_follow_button" id="et_pb_follow_button">
						<option value="off"<%= typeof( et_pb_follow_button ) !== 'undefined' && 'off' === et_pb_follow_button ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Off', 'Divi' );
echo <<<END
</option>
						<option value="on"<%= typeof( et_pb_follow_button ) !== 'undefined' && 'on' === et_pb_follow_button ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'On', 'Divi' );
echo <<<END
</option>
					</select>
					<p class="description">
END;
esc_html_e( 'Here you can choose whether or not to include the follow button next to the icon.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="admin_label">
END;
esc_html_e( 'Admin Label', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="admin_label" type="text" class="regular-text" value="<%= typeof( admin_label ) !== 'undefined' ?  admin_label : '' %>" />
					<p class="description">
END;
esc_html_e( 'This will change the label of the module in the builder for easy identification.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_id">
END;
esc_html_e( 'CSS ID', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_id" type="text" class="regular-text" value="<%= typeof( et_pb_module_id ) !== 'undefined' ?  et_pb_module_id : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter an optional CSS ID to be used for this module. An ID can be used to create custom CSS styling, or to create links to particular sections of your page.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_module_class">
END;
esc_html_e( 'CSS Class', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">
					<input id="et_pb_module_class" type="text" class="regular-text" value="<%= typeof( et_pb_module_class ) !== 'undefined' ?  et_pb_module_class : '' %>" />
					<p class="description">
END;
esc_html_e( 'Enter optional CSS classes to be used for this module. A CSS class can be used to create custom CSS styling. You can add multiple classes, separated with a space.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->
		</div>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_social_media_follow_network-title">
		<%= typeof( et_pb_content_new ) !== 'undefined' && typeof( et_pb_content_new ) === 'string' ?  et_pb_content_new : '
END;
esc_html_e( 'New Social Network', 'Divi' );
echo <<<END
' %>
	</script>

	<script type="text/template" id="et-builder-advanced-setting-et_pb_social_media_follow_network">
		<h3 class="et-pb-settings-heading">
END;
esc_html_e( 'Social Network Settings', 'Divi' );
echo <<<END
</h3>

		<div class="et-pb-main-settings">

			<div class="et-pb-option">
				<label for="et_pb_social_network">
END;
esc_html_e( 'Social Network', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<select name="et_pb_social_network" id="et_pb_social_network" class="et-pb-social-network">
						<option data-color="" value="" <%= typeof( et_pb_social_network ) === 'undefined' || '' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Select a Network', 'Divi' );
echo <<<END
</option>
						<option data-color="#3b5998" value="facebook"<%= typeof( et_pb_social_network ) !== 'undefined' && 'facebook' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'facebook', 'Divi' );
echo <<<END
</option>
						<option data-color="#00aced" value="twitter"<%= typeof( et_pb_social_network ) !== 'undefined' && 'twitter' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Twitter', 'Divi' );
echo <<<END
</option>
						<option data-color="#dd4b39" value="google-plus"<%= typeof( et_pb_social_network ) !== 'undefined' && 'google-plus' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Google+', 'Divi' );
echo <<<END
</option>
						<option data-color="#cb2027" value="pinterest"<%= typeof( et_pb_social_network ) !== 'undefined' && 'pinterest' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Pinterest', 'Divi' );
echo <<<END
</option>
						<option data-color="#007bb6" value="linkedin"<%= typeof( et_pb_social_network ) !== 'undefined' && 'linkedin' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'LinkedIn', 'Divi' );
echo <<<END
</option>
						<option data-color="#32506d" value="tumblr"<%= typeof( et_pb_social_network ) !== 'undefined' && 'tumblr' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'tumblr', 'Divi' );
echo <<<END
</option>
						<option data-color="#517fa4" value="instagram"<%= typeof( et_pb_social_network ) !== 'undefined' && 'instagram' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Instagram', 'Divi' );
echo <<<END
</option>
						<option data-color="#12A5F4" value="skype"<%= typeof( et_pb_social_network ) !== 'undefined' && 'skype' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'skype', 'Divi' );
echo <<<END
</option>
						<option data-color="#ff0084" value="flikr"<%= typeof( et_pb_social_network ) !== 'undefined' && 'flikr' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'flikr', 'Divi' );
echo <<<END
</option>
						<option data-color="#3b5998" value="myspace"<%= typeof( et_pb_social_network ) !== 'undefined' && 'myspace' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'MySpace', 'Divi' );
echo <<<END
</option>
						<option data-color="#ea4c8d" value="dribbble"<%= typeof( et_pb_social_network ) !== 'undefined' && 'dribbble' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'dribbble', 'Divi' );
echo <<<END
</option>
						<option data-color="#a82400" value="youtube"<%= typeof( et_pb_social_network ) !== 'undefined' && 'youtube' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Youtube', 'Divi' );
echo <<<END
</option>
						<option data-color="#45bbff" value="vimeo"<%= typeof( et_pb_social_network ) !== 'undefined' && 'vimeo' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'Vimeo', 'Divi' );
echo <<<END
</option>
						<option data-color="#ff8a3c" value="rss"<%= typeof( et_pb_social_network ) !== 'undefined' && 'rss' === et_pb_social_network ?  ' selected="selected"' : '' %>>
END;
esc_html_e( 'RSS', 'Divi' );
echo <<<END
</option>
					</select>

					<p class="description">
END;
esc_html_e( 'Choose the social network', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option" style="display:none;">
				<div class="et-pb-option-container">
					<input id="et_pb_content_new" type="hidden" class="regular-text" value="<%= typeof( et_pb_content_new ) !== 'undefined' ?  et_pb_content_new : '' %>" />
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_url">
END;
esc_html_e( 'Account URL', 'Divi' );
echo <<<END
: </label>
				<div class="et-pb-option-container">
					<input id="et_pb_url" type="text" class="regular-text" value="<%= typeof( et_pb_url ) !== 'undefined' ?  et_pb_url : '' %>" />

					<p class="description">
END;
esc_html_e( 'The URL for this social network link.', 'Divi' );
echo <<<END
</p>
				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->

			<div class="et-pb-option">
				<label for="et_pb_bg_color">
END;
esc_html_e( 'Icon Color', 'Divi' );
echo <<<END
: </label>

				<div class="et-pb-option-container">

					<input id="et_pb_bg_color" class="et-pb-color-picker-hex" type="text" maxlength="7" placeholder="
END;
esc_html_e( 'Hex Value', 'Divi' );
echo <<<END
" value="<%= typeof( et_pb_bg_color ) !== 'undefined' && et_pb_bg_color !== '' ?  et_pb_bg_color : '
END;
echo esc_html( et_get_option( 'accent_color', '#7EBEC5' ) );
echo <<<END
' %>" />
					<input type="button" class="et-pb-reset reset-default-color button" value="
END;
esc_html_e( 'Reset Color', 'Divi' );
echo <<<END
" />
					<p class="description">
END;
esc_html_e( 'This will change the icon color.', 'Divi' );
echo <<<END
</p>

				</div> <!-- .et-pb-option-container -->
			</div> <!-- .et-pb-option -->


		</div>
	</script>

	<!-- end et_pb_social_media_follow -->

	<script type="text/template" id="et-builder-column-template">
		<a href="#" class="et-pb-insert-module"><span>
END;
esc_html_e( 'Insert Module(s)', 'Divi' );
echo <<<END
</span></a>
	</script>

	<script type="text/template" id="et-builder-prompt-modal-deactivate_builder-text">
		<p>
END;
esc_html_e( 'All content created in the Page Builder will be lost. Previous content will be restored.', 'Divi' );
echo <<<END
</p>
		<p>
END;
esc_html_e( 'Do you want to proceed?', 'Divi' );
echo <<<END
</p>
	</script>

	<script type="text/template" id="et-builder-prompt-modal-clear_layout-text">
		<p>
END;
esc_html_e( 'All content created in the Page Builder will be lost.', 'Divi' );
echo <<<END
</p>
		<p>
END;
esc_html_e( 'Do you want to proceed?', 'Divi' );
echo <<<END
</p>
	</script>

	<script type="text/template" id="et-builder-prompt-modal-save_layout-text">
		<p>
END;
esc_html_e( 'You can save the Page Builder Layout for later use here.', 'Divi' );
echo <<<END
</p>
		<label>
END;
esc_html_e( 'Layout Name', 'Divi' );
echo <<<END
: <input type="text" value="" id="et_pb_new_layout_name" class="regular-text" /></label>
	</script>

	<script type="text/template" id="et-builder-prompt-modal-save_layout">
		<div class="et_pb_prompt_modal">
			<div class="et_pb_prompt_buttons">
				<br/>
				<input type="submit" class="et_pb_prompt_proceed button-primary" value="
END;
esc_html_e( 'Save', 'Divi' );
echo <<<END
" />
				<a href="#" class="et_pb_prompt_dont_proceed button">
END;
esc_html_e( 'Close Modal Window', 'Divi' );
echo <<<END
</a>
			</div>
		</div>
	</script>

	<script type="text/template" id="et-builder-prompt-modal">
		<div class="et_pb_prompt_modal">
			<div class="et_pb_prompt_buttons">
				<a href="#" class="et_pb_prompt_proceed button-primary">
END;
esc_html_e( 'Yes', 'Divi' );
echo <<<END
</a>
				<a href="#" class="et_pb_prompt_dont_proceed button">
END;
esc_html_e( 'No', 'Divi' );
echo <<<END
</a>
			</div>
		</div>
	</script>
END;

	do_action( 'et_pb_after_page_builder' );
}