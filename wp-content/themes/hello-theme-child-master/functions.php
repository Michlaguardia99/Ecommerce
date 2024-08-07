<?php

/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0');

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles()
{

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_uri(),
		[
			'hello-elementor-theme-style', // Use the correct handle for the parent theme's stylesheet.
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);
}
add_action('wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20);

// Enqueue child theme stylesheet
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');
function child_theme_enqueue_styles()
{
	wp_enqueue_style('child-style', get_stylesheet_uri(), array('hello-elementor-theme-style'), wp_get_theme()->get('Version'));
}


// Add Hot and New badges to archives
function woo_product_archive_badges()
{
	global $product;
	$days_to_show = 30;
	$sales_threshold = 100;

	$product_published_date = strtotime($product->get_date_created());
	$total_sales = $product->get_total_sales();

	if ((time() - (60 * 60 * 24 * $days_to_show)) < $product_published_date) {
		echo '<span class="new-badge">' . 'NEW' . '</span>';
	}

	if ($total_sales >= $sales_threshold) {
		echo '<span class="hot-badge">' . 'HOT' . '</span>';
	}
}

// Add Hot and New badges to single products
function woo_single_product_badges()
{
	global $product;
	$days_to_show = 30;
	$sales_threshold = 100;

	$product_published_date = strtotime($product->get_date_created());
	$total_sales = $product->get_total_sales();

	if ((time() - (60 * 60 * 24 * $days_to_show)) < $product_published_date) {
		echo '<span class="new-badge">' . 'NEW' . '</span>';
	}

	if ($total_sales >= $sales_threshold) {
		echo '<span class="hot-badge">' . 'HOT' . '</span>';
	}
}

// Replace sale text
function ds_replace_sale_text($text)
{
	global $product;
	$stock = $product->get_stock_status();
	$product_type = $product->get_type();
	$sale_price  = 0;
	$regular_price = 0;

	if ($product_type == 'variable') {
		$product_variations = $product->get_available_variations();
		foreach ($product_variations as $kay => $value) {
			if ($value['display_price'] < $value['display_regular_price']) {
				$sale_price = $value['display_price'];
				$regular_price = $value['display_regular_price'];
			}
		}
		if ($regular_price > $sale_price && $stock != 'outofstock') {
			$price_difference = number_format($regular_price - $sale_price, 0, '', '');
			return '<span class="onsale"> <span class="sale-icon" aria-hidden="true" data-icon="&#xe0da"></span>-$' . $price_difference . '</span>';
		} else {
			return '';
		}
	} else {
		$regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
		$sale_price = get_post_meta(get_the_ID(), '_sale_price', true);

		if ($regular_price > $sale_price) {
			$price_difference = number_format($regular_price - $sale_price, 0, '', '');
			return '<span class="onsale"> <span class="sale-icon" aria-hidden="true" data-icon="&#xe0da"></span>-$' . $price_difference . '</span>';
		} else {
			return '';
		}
	}
}

// Add star rating
function add_star_rating()
{
	global $woocommerce, $product;
	$average = $product->get_average_rating();
	$review_count = $product->get_review_count();

	echo '<div class="star-rating"> <div class="number-of-reviews"> ' . $review_count . ' Review</div></div>';
}

function custom_post_archive_shortcode($atts)
{
	$atts = shortcode_atts(array(
		'posts_per_page' => -1,
	), $atts);

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $atts['posts_per_page'],
		'order'          => 'ASC',
	);

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		$output = '<div class="custom-post-archive flex-start-between">';
		while ($query->have_posts()) : $query->the_post();
			$pageId = get_the_ID();
			$author = get_field("post_author", $pageId);
			$userId = get_post_field('post_author', $pageId);
			$userAdmin = get_the_author_meta('user_login', $userId);
			$commentCount = get_comments_number($pageId);

			ob_start();
			include(get_stylesheet_directory() . '/template-parts/blogs/custom-post-archive.php');
			$output .= ob_get_clean();
		endwhile;
		$output .= '</div>';

		wp_reset_postdata();

	else :
		$output = '<p>No posts found</p>';
	endif;

	return $output;
}

function inner_body_class($classes)
{
	if (!is_front_page()) {
		$classes[] = 'inner';
	}
	return $classes;
}

function add_page_name_to_body_class($classes)
{
	global $post;

	if (is_singular() && isset($post)) {
		$classes[] = $post->post_name;
	}

	return $classes;
}


// Add Hot and New badges to archives
add_action('woocommerce_after_shop_loop_item_title', 'woo_product_archive_badges', 1);

// Add Hot and New badges to single products
add_action('woocommerce_single_product_summary', 'woo_single_product_badges', 1);

// Add star rating
add_action('woocommerce_after_shop_loop_item', 'add_star_rating');

// Custom archive
add_shortcode('custom_post_archive', 'custom_post_archive_shortcode');

// Add .inner class to inner pages
add_filter('body_class', 'inner_body_class');

// Add page name as class to inner pages
add_filter('body_class', 'add_page_name_to_body_class');

// Replace sale text
add_filter('woocommerce_sale_flash', 'ds_replace_sale_text');


add_theme_support('woocommerce');
