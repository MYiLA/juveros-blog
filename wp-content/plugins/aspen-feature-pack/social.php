<?php
/**
 * Social Media Sharing Features & Author Contact Information
 *
 * @package aspen-features
 */

/**
 * Register User Contact Methods
 */
if ( ! function_exists( 'aspen_features_user_contact_methods' ) ) {
	function aspen_features_user_contact_methods( $user_contact_method ) {
		$user_contact_method['facebook']  = esc_html__( 'Facebook Username', 'aspen-features' );
		$user_contact_method['twitter']   = esc_html__( 'Twitter Username', 'aspen-features' );
		$user_contact_method['gplus']     = esc_html__( 'Google Plus', 'aspen-features' );
		$user_contact_method['skype']     = esc_html__( 'Skype Username', 'aspen-features' );
		$user_contact_method['linkedin']  = esc_html__( 'LinkedIn Profile URL', 'aspen-features' );
		$user_contact_method['instagram'] = esc_html__( 'Instagram Username', 'aspen-features' );
		$user_contact_method['pinterest'] = esc_html__( 'Pinterest Username', 'aspen-features' );
		$user_contact_method['flickr']    = esc_html__( 'Flickr Username', 'aspen-features' );
		$user_contact_method['tumblr']    = esc_html__( 'Tumblr Profile URL', 'aspen-features' );
		$user_contact_method['youtube']   = esc_html__( 'YouTube Channel URL', 'aspen-features' );
		$user_contact_method['vimeo']     = esc_html__( 'Vimeo Username', 'aspen-features' );

		return $user_contact_method;
	}
}
add_filter( 'user_contactmethods', 'aspen_features_user_contact_methods' );

/**
 * Social Media Block for Users
 */
if ( ! function_exists( 'aspen_features_author_social' ) ) {
	function aspen_features_author_social() {
		$author_id = get_the_author_meta( 'ID' );
		$user_data = get_userdata( $author_id );

		$social = array();

		$social['website'] = array(
			'value'  => $user_data->user_url,
			'icon'   => 'fa fa-home fa-1x',
			'label'  => esc_html__( 'Website', 'aspen-features' ),
			'prefix' => ''
		);

		$social['twitter'] = array(
			'value'  => get_user_meta( $author_id, 'twitter', true ),
			'icon'   => 'fa fa-twitter fa-1x',
			'label'  => esc_html__( 'Twitter', 'aspen-features' ),
			'prefix' => 'https://www.twitter.com/'
		);

		$social['facebook'] = array(
			'value'  => get_user_meta( $author_id, 'facebook', true ),
			'icon'   => 'fa fa-facebook fa-1x',
			'label'  => esc_html__( 'Facebook', 'aspen-features' ),
			'prefix' => 'https://www.facebook.com/'
		);

		$social['googleplus'] = array(
			'value'  => get_user_meta( $author_id, 'gplus', true ),
			'icon'   => 'fa fa-google-plus fa-1x',
			'label'  => esc_html__( 'Google+', 'aspen-features' ),
			'prefix' => 'https://plus.google.com/'
		);

		$social['skype'] = array(
			'value'  => get_user_meta( $author_id, 'skype', true ),
			'icon'   => 'fa fa-skype fa-1x',
			'label'  => esc_html__( 'Skype', 'aspen-features' ),
			'prefix' => 'skype://'
		);

		$social['linkedin'] = array(
			'value'  => get_user_meta( $author_id, 'linkedin', true ),
			'icon'   => 'fa fa-linkedin fa-1x',
			'label'  => esc_html__( 'LinkedIn', 'aspen-features' ),
			'prefix' => ''
		);

		$social['instagram'] = array(
			'value'  => get_user_meta( $author_id, 'instagram', true ),
			'icon'   => 'fa fa-instagram fa-1x',
			'label'  => esc_html__( 'Instagram', 'aspen-features' ),
			'prefix' => 'https://instagram.com/'
		);

		$social['pinterest'] = array(
			'value'  => get_user_meta( $author_id, 'pinterest', true ),
			'icon'   => 'fa fa-pinterest fa-1x',
			'label'  => esc_html__( 'Pinterest', 'aspen-features' ),
			'prefix' => 'https://www.pinterest.com/'
		);

		$social['flickr'] = array(
			'value'  => get_user_meta( $author_id, 'flickr', true ),
			'icon'   => 'fa fa-flickr fa-1x',
			'label'  => esc_html__( 'Flickr', 'aspen-features' ),
			'prefix' => 'https://www.flickr.com/photos/'
		);

		$social['tumblr'] = array(
			'value'  => get_user_meta( $author_id, 'tumblr', true ),
			'icon'   => 'fa fa-tumblr fa-1x',
			'label'  => esc_html__( 'Tumblr', 'aspen-features' ),
			'prefix' => ''
		);

		$social['foursquare'] = array(
			'value'  => get_user_meta( $author_id, 'foursquare', true ),
			'icon'   => 'fa fa-foursquare fa-1x',
			'label'  => esc_html__( 'Foursquare', 'aspen-features' ),
			'prefix' => 'https://foursquare.com/'
		);

		$social['youtube'] = array(
			'value'  => get_user_meta( $author_id, 'youtube', true ),
			'icon'   => 'fa fa-youtube fa-1x',
			'label'  => esc_html__( 'YouTube', 'aspen-features' ),
			'prefix' => ''
		);

		$social['vimeo'] = array(
			'value'  => get_user_meta( $author_id, 'vimeo', true ),
			'icon'   => 'fa fa-vimeo-square fa-1x',
			'label'  => esc_html__( 'Vimeo', 'aspen-features' ),
			'prefix' => 'https://vimeo.com/'
		);


		$output = '';
		foreach ( $social as $service => $meta ) {
			$value = $meta['value'];
			if ( $value ) {
				$output .= '<li><a href="' . esc_url( $meta['prefix'] . $meta['value'] ) . '" target="_blank" class="' . $service . '"><i class="' . esc_attr( $meta['icon'] ) . '"></i><span>' . esc_html( $meta['label'] ) . '</span></a></li>' . "\n";
			}
		}

		if ( $output ) {
			echo '<ul class="social-icons icon-size-1">' . "\n";
			echo apply_filters( 'aspen_features_social_icons_output', $output ) . "\n";
			echo '</ul>' . "\n";
		}

	}

}


/**
 * Scripts
 */

function aspen_features_social_register_scripts() {
	if ( aspen_features_show_share() ) {
		wp_enqueue_script( 'aspen-features-pin', plugins_url( 'assets/js/hc-sticky.js', __FILE__ ), array( 'jquery' ), '1.0.8', true );
		wp_enqueue_script( 'aspen-features', plugins_url( 'assets/js/aspen_features.js', __FILE__ ), array(
			'jquery',
			'aspen-features-pin'
		), '1.0.8', true );
	}
}

add_action( 'wp_enqueue_scripts', 'aspen_features_social_register_scripts' );


/**
 * Backend Interface Options
 */

function aspen_features_social_sharing_options( $socialTab ) {

	$services = array(
		'twitter'     => esc_html__( 'Twitter', 'aspen-features' ),
		'facebook'    => esc_html__( 'Facebook', 'aspen-features' ),
		'google'      => esc_html__( 'Google+', 'aspen-features' ),
		'pinterest'   => esc_html__( 'Pinterest', 'aspen-features' ),
		'linkedin'    => esc_html__( 'LinkedIn', 'aspen-features' ),
		'tumblr'      => esc_html__( 'Tumblr', 'aspen-features' ),
		'reddit'      => esc_html__( 'Reddit', 'aspen-features' ),
		'stumbleupon' => esc_html__( 'StumbleUpon', 'aspen-features' ),
		'vk'          => esc_html__( 'VKontakte', 'aspen-features' )
	);

	$services = apply_filters( 'aspen_share_social_services', $services );

	$socialTab->createOption( array(
		'name' => esc_html__( 'Social Sharing Icons', 'aspen-features' ),
		'type' => 'heading',
	) );

	$socialTab->createOption( array(
		'name'           => esc_html__( 'Social Icons', 'aspen-features' ),
		'id'             => 'social_icons_sharing',
		'type'           => 'sortable',
		'visible_button' => true,
		'options'        => $services

	) );

}

add_action( 'aspen_after_social_links', 'aspen_features_social_sharing_options', 10, 1 );


function aspen_features_blog_options( $section ) {

	$section->createOption( array(
		'name' => esc_html__( 'Social Sharing', 'aspen-features' ),
		'type' => 'heading',
	) );

	$section->createOption( array(
		'name'    => esc_html__( 'Show Social Sharing Icons', 'aspen-features' ),
		'id'      => 'blog_single_show_share',
		'type'    => 'checkbox',
		'default' => true,
	) );

}

add_action( 'aspen_after_blog_options', 'aspen_features_blog_options', 10, 1 );


/**
 * Helper Functions
 */

if ( ! function_exists( 'aspen_features_show_share' ) ) {
	function aspen_features_show_share( $single = false ) {

		if ( function_exists( 'aspen_option' ) ) {

			$show = aspen_option( 'blog_single_show_share' );
			if ( $show ) {
				return true;
			} else {
				return false;
			}

		}

	}
}

if ( ! function_exists( 'aspen_features_do_share' ) ) {
	function aspen_features_do_share( $post = false, $toggle = false ) {

		if ( aspen_features_show_share() ) {
			aspen_features_post_share_output( $post, $toggle );
		}
	}

}
add_action( 'aspen_share', 'aspen_features_do_share', 10, 2 );


/**
 * Output
 */

if ( ! function_exists( 'aspen_features_body_classes' ) ) {
	function aspen_features_body_classes( $classes ) {

		if ( function_exists ( 'aspen_option') ) {

			if ( is_single() && function_exists( 'aspen_option' ) && aspen_option( 'blog_single_show_share' ) ) {
				$classes[] = 'blog-has-sharing-icons';
			} else {
				$classes[] = 'blog-no-sharing-icons';
			}

		}

		return $classes;
	}
}
add_filter( 'body_class', 'aspen_features_body_classes' );

if ( ! function_exists( 'aspen_features_post_share_output' ) ) {
	function aspen_features_post_share_output( $post = false, $toggle = false ) {

		$services = array(
			'twitter'    => array(
				'label' => esc_html__( 'Twitter', 'aspen-features' ),
				'icon'  => 'fa-twitter',
				'url'   => 'https://twitter.com/intent/tweet?url={url}&text={title}'
			),
			'facebook'   => array(
				'label' => esc_html__( 'Facebook', 'aspen-features' ),
				'icon'  => 'fa-facebook',
				'url'   => 'https://www.facebook.com/sharer.php?u={url}'
			),
			'googleplus' => array(
				'label' => esc_html__( 'Google+', 'aspen-features' ),
				'icon'  => 'fa-google-plus',
				'url'   => 'https://plus.google.com/share?url={url}'
			),
			'pinterest'  => array(
				'label' => esc_html__( 'Pinterest', 'aspen-features' ),
				'icon'  => 'fa-pinterest',
				'url'   => 'https://pinterest.com/pin/create/bookmarklet/?&url={url}&description={title}'
			),
			'linkedin' => array(
				'label' => esc_html__( 'LinkedIn', 'aspen-features' ),
				'icon'  => 'fa-linkedin',
				'url'   => 'https://www.linkedin.com/shareArticle?url={url}&title={title}'
			),
			'reddit' => array(
				'label' => esc_html__( 'Reddit', 'aspen-features' ),
				'icon'  => 'fa-reddit',
				'url'   => 'https://reddit.com/submit?url={url}&title={title}'
			),
			'tumblr' => array(
				'label' => esc_html__( 'Tumblr', 'aspen-features' ),
				'icon'  => 'fa-tumblr',
				'url'   => 'https://www.tumblr.com/share/link?url={url}&name={title}'
			),
			'stumbleupon' => array(
				'label' => esc_html__( 'StumbleUpon', 'aspen-features' ),
				'icon'  => 'fa-stumbleupon',
				'url'   => 'https://www.stumbleupon.com/submit?url={url}&title={title}'
			),
			'vk' => array(
				'label' => esc_html__( 'vkontakte', 'aspen-features' ),
				'icon'  => 'fa-vk',
				'url'   => 'http://oauth.vk.com/authorize?client_id=-1&redirect_uri={url}&display=widget&caption={title}'
			),
		);

		$services = apply_filters( 'aspen_share_social_services_links', $services );

		$selected_services = aspen_option( 'social_icons_sharing' );

		if ( empty ( $selected_services ) ) {
			return;
		}

		?>
		<!--Start of Post Share-->
		<?php if ( $post ) : ?><aside class="sharing-box"><?php endif; ?>
		<?php if ( $post ) : ?><span><?php esc_html_e( 'SHARE', 'aspen-features' ); ?></span><?php endif; ?>
		<ul class="social-icons icon-size-1">
			<?php foreach ( $selected_services as $slug ) :
				if ( ! empty ( $services[ $slug ] ) ) :
					$service = $services[ $slug ];
					$url = $service['url'];
					$url = str_replace( '{url}', get_permalink(), $url );
					$url = str_replace( '{title}', get_the_title(), $url );
					?>
					<li>
						<a href="<?php echo esc_url( $url ); ?>" target="_blank" class="<?php echo esc_attr( $slug ); ?>"><i class="fa <?php echo esc_attr( $service['icon'] ); ?> fa-1x"></i><span><?php echo esc_html( $service['label'] ); ?></span></a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php if ( $post ) : ?></aside><?php endif; ?>
		<!--End of Post Share-->
		<?php
	}
}
