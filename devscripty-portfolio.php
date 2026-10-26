<?php
/**
 * Plugin Name: DevScripty Portfolio
 * Description: Portfolio grid with filters and case-study popup. Use the shortcode [devscripty_portfolio].
 * Version: 1.0.0
 * Author: DevScripty
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DSW_URL', plugin_dir_url( __FILE__ ) );
define( 'DSW_VER', '1.0.0' );

/**
 * Folder of the images inside the Media Library.
 * Images are built from THIS site's uploads URL, so they always come from the
 * same domain as the page (no hotlinking, no cross-domain 403).
 */
function dsw_image_url( $file ) {
	$uploads = wp_get_upload_dir();
	$base    = trailingslashit( $uploads['baseurl'] ) . '2026/10/';
	$base    = apply_filters( 'dsw_image_base', $base );
	return set_url_scheme( $base . $file );
}

function dsw_categories() {
	return array(
		'wp'      => 'WordPress',
		'shopify' => 'Shopify',
		'landing' => 'Landing Pages',
		'ghl'     => 'GoHighLevel',
	);
}

function dsw_projects() {
	return array(
		array(
			'n' => 'Uselite Wine', 'cat' => 'wp', 'badge' => 'WooCommerce', 'chip' => 'WordPress / WooCommerce',
			'img' => 'Muscat.webp', 'u' => 'https://uselitewine.com/',
			'sub' => 'Legacy System Migration to WooCommerce',
			's' => 'Rebuilt from a slow legacy system into a stable WordPress & WooCommerce store, with wholesale access control.',
			'icon' => 'fa-chart-line', 'foot' => '2,707 orders migrated',
			'd' => 'The old website was slow, unstable and losing orders. Customers could not complete checkout, and the client depended on a legacy system that kept breaking. I built a new WordPress & WooCommerce website from scratch, migrated 2,707 orders and 885 users without losing a single record, and optimized every step of the buying process.',
			'res' => array( 'Stable, high-performance website', 'Seamless checkout', 'Wholesale access control: pricing visible only to logged-in buyers', 'No more legacy system problems' ),
			'stack' => array( 'WordPress', 'WooCommerce', 'Breakdance', 'PHP' ),
		),
		array(
			'n' => 'Soda Detour', 'cat' => 'wp', 'badge' => 'Breakdance 2.2', 'chip' => 'WordPress / Breakdance',
			'img' => 'sodatour.webp', 'u' => 'https://sodadetour.com/?currency=CVE',
			'sub' => 'Modern & Visually Engaging Layout',
			's' => 'Responsive WordPress site on Breakdance 2.2 with a modern layout and intuitive navigation.',
			'icon' => 'fa-mobile-screen', 'foot' => 'Fully Responsive',
			'd' => 'Designed a responsive WordPress site using Breakdance 2.2, focusing on a modern and visually engaging layout. While the content was provided by the client, I carefully crafted the design to ensure intuitive navigation, clear CTAs and a seamless user experience across all devices. The site was optimized for performance and usability.',
			'res' => array( 'Modern layout', 'Intuitive navigation', 'Clear CTAs' ),
			'stack' => array( 'WordPress', 'Breakdance 2.2' ),
		),
		array(
			'n' => 'CVC Society', 'cat' => 'wp', 'badge' => 'Breakdance + SEO', 'chip' => 'WordPress / Breakdance',
			'img' => 'ChildrenCamp.webp', 'u' => 'https://www.cvcsociety.com/',
			'sub' => 'Niche-Specific SEO & Redesign',
			's' => 'Redesigned with Breakdance and a niche-specific SEO content strategy to boost search visibility.',
			'icon' => 'fa-magnifying-glass-chart', 'foot' => 'SEO Optimized',
			'd' => 'I redesigned the site using Breakdance Builder and developed a niche-specific SEO content strategy to boost search visibility. By optimizing on-page structure and content relevance, I improved user experience and professional branding.',
			'res' => array( 'Boosted search visibility', 'Improved UX', 'Professional branding' ),
			'stack' => array( 'WordPress', 'Breakdance', 'SEO' ),
		),
		array(
			'n' => 'Takoda Equine', 'cat' => 'wp', 'badge' => 'Elementor', 'chip' => 'WordPress / Elementor',
			'img' => 'takodahorse.webp', 'u' => 'https://www.takodaequine.com/',
			'sub' => 'Elementor Development & Admin Optimization',
			's' => 'Elementor build with an optimized WordPress admin, so content is easy to manage.',
			'icon' => 'fa-gears', 'foot' => 'Admin Optimized',
			'd' => 'Website built on Elementor. A key part of the project was optimizing the WordPress admin dashboard, so the client can manage content without a cluttered backend.',
			'res' => array( 'Clean admin panel', 'Easy content management' ),
			'stack' => array( 'WordPress', 'Elementor' ),
		),
		array(
			'n' => 'Mitch Carson', 'cat' => 'wp', 'badge' => 'Technical SEO', 'chip' => 'WordPress / SEO',
			'img' => 'CoachWeb.webp', 'u' => 'https://www.mitchcarson.com/',
			'sub' => 'Global Coaching & Media Infrastructure',
			's' => 'Core digital infrastructure for a global coaching and media platform, with technical SEO for 134 posts.',
			'icon' => 'fa-magnifying-glass', 'foot' => '134 posts structured',
			'd' => 'Engineered and optimized the core digital infrastructure for a high-authority global coaching and media platform. I wrote and structured content for pages and 134 posts, set up comprehensive technical SEO, resolved broken links, refined UI elements and tuned CSS to maximize search visibility and load speed.',
			'res' => array( '134 posts structured', 'Technical SEO setup', 'CSS tuning' ),
			'stack' => array( 'WordPress', 'Technical SEO', 'CSS' ),
		),
		array(
			'n' => 'Mofficer', 'cat' => 'shopify', 'badge' => 'Shopify', 'chip' => 'Shopify / Custom code',
			'img' => 'ShopifyWeb.webp', 'u' => 'https://mofficer.com.br/',
			'sub' => 'Shopify E-commerce Refinement',
			's' => 'Shopify store aligned with the Figma design, with optimized product pages, menus and checkout.',
			'icon' => 'fa-code', 'foot' => 'Custom Code',
			'd' => 'Refined the Shopify e-commerce site to align with the Figma design, optimizing product pages, menus and checkout for a smoother experience. I also added custom code to enhance performance and responsiveness across devices, so customers enjoy a faster, more seamless shopping journey.',
			'res' => array( 'Figma alignment', 'Custom code added', 'Faster shopping journey' ),
			'stack' => array( 'Shopify', 'Custom Code', 'Figma' ),
		),
		array(
			'n' => 'Made by Nami', 'cat' => 'shopify', 'badge' => 'Shopify', 'chip' => 'Shopify / E-commerce',
			'img' => 'madebynami.webp', 'u' => 'https://madebynami.de/',
			'sub' => 'Handmade Boho Jewelry Store',
			's' => 'Shopify store for handmade boho bracelets and anklets, built for a clean and easy shopping experience.',
			'icon' => 'fa-bag-shopping', 'foot' => 'Shopify Store',
			'd' => 'An e-commerce store on Shopify for Made by Nami, a German brand of handmade boho bracelets and anklets. The store is built so customers can browse the collections and check out easily on any device.',
			'res' => array( 'Clean product catalog', 'Mobile-friendly shopping', 'Simple checkout' ),
			'stack' => array( 'Shopify', 'Liquid' ),
		),
		array(
			'n' => 'Montemadeira Hotel', 'cat' => 'wp', 'badge' => 'Breakdance', 'chip' => 'WordPress / Breakdance',
			'img' => 'HotelWeb.webp', 'u' => 'https://montemadeiralhotel.com.cv/',
			'sub' => 'From-Scratch Hospitality Site',
			's' => 'Built entirely from scratch on WordPress and Breakdance for a premium hospitality experience.',
			'icon' => 'fa-hotel', 'foot' => 'Built From Scratch',
			'd' => 'Built entirely from scratch using WordPress and Breakdance for a premium hospitality experience.',
			'res' => array( 'Built from scratch', 'Premium design' ),
			'stack' => array( 'WordPress', 'Breakdance' ),
		),
		array(
			'n' => 'Tartan Kilts Direct', 'cat' => 'wp', 'badge' => 'UX Builder + SEO', 'chip' => 'WordPress / UX Builder',
			'img' => 'Kilts.webp', 'u' => 'https://tartankiltsdirect.co.uk/',
			'sub' => 'UX Builder & SEO Strategy',
			's' => 'Created on UX Builder with a comprehensive focus on SEO and site structure.',
			'icon' => 'fa-magnifying-glass', 'foot' => 'SEO Strategy',
			'd' => 'Created on UX Builder. I handled the comprehensive SEO setup, optimizing the site structure and content to improve search engine rankings.',
			'res' => array( 'Comprehensive SEO', 'Site structure' ),
			'stack' => array( 'WordPress', 'UX Builder', 'SEO' ),
		),
		array(
			'n' => 'Everest Hockey Group', 'cat' => 'wp', 'badge' => 'Elementor + WooCommerce', 'chip' => 'WordPress / Elementor Pro',
			'img' => 'Hockey_EA_2021_06.webp', 'u' => 'https://everesthockeygroup.com/',
			'sub' => 'Custom WooCommerce Forms',
			's' => 'Corrected complex WooCommerce forms for gear purchases, team registrations and competition entries.',
			'icon' => 'fa-pen-to-square', 'foot' => 'Custom Forms',
			'd' => 'Created using Elementor Pro and WooCommerce. I corrected complex forms for purchasing hockey gear, registering children for teams and registering entire teams for competitions.',
			'res' => array( 'Custom form logic', 'Team registration', 'Gear purchasing' ),
			'stack' => array( 'WordPress', 'Elementor Pro', 'WooCommerce' ),
		),
		array(
			'n' => 'AJ Towing', 'cat' => 'wp', 'badge' => 'Breakdance', 'chip' => 'WordPress / Breakdance',
			'img' => 'TowingWeb.webp', 'u' => 'https://ajtowinginc.com/',
			'sub' => 'Local Service Site Content & Media',
			's' => 'Created new pages, populated content, and optimized and converted images for a fast local service site.',
			'icon' => 'fa-image', 'foot' => 'Media Optimization',
			'd' => 'Created new pages for the local towing service, populated them with content, and optimized and converted images to improve loading speed and visual appeal.',
			'res' => array( 'New pages created', 'Image optimization' ),
			'stack' => array( 'WordPress', 'Breakdance' ),
		),
		array(
			'n' => 'West Galil', 'cat' => 'wp', 'badge' => 'Figma to WP', 'chip' => 'WordPress / Elementor',
			'img' => 'WestGalWeb.webp', 'u' => 'https://www.westgalil.org.il/',
			'sub' => 'Figma to WordPress with Custom Fields',
			's' => 'Built pixel for pixel from Figma, with custom fields for seamless event and post management.',
			'icon' => 'fa-crop-simple', 'foot' => 'Figma to WP',
			'd' => 'Built pixel-perfect from a Figma design. I constructed custom fields to make it easy for the client to manage and fill in events and other posts.',
			'res' => array( 'Pixel-perfect build', 'Custom event fields' ),
			'stack' => array( 'WordPress', 'Elementor', 'Figma' ),
		),
		array(
			'n' => 'DM Wright Solutions', 'cat' => 'ghl', 'badge' => 'GoHighLevel', 'chip' => 'GoHighLevel Website',
			'img' => 'dmwrightWeb.webp', 'u' => 'https://dmwrightsolutions.com/',
			'sub' => 'GoHighLevel Website',
			's' => 'Business website built on the GoHighLevel platform.',
			'icon' => 'fa-diagram-project', 'foot' => 'GoHighLevel Build',
			'd' => 'A business website built on the GoHighLevel platform.',
			'res' => array(),
			'stack' => array( 'GoHighLevel' ),
		),
		array(
			'n' => 'Verve Health Product Launch', 'cat' => 'landing', 'badge' => 'Landing Page', 'chip' => 'Landing Page Development',
			'img' => 'IMG_6816-scaled-1.webp', 'u' => 'https://red-chicken-656297.hostingersite.com/',
			'sub' => 'Ultrafast Sales & Campaign Landing Page',
			's' => 'Standalone landing page for a high-ad-spend campaign, with sticky urgency callouts and fast mobile rendering.',
			'icon' => 'fa-bolt', 'foot' => 'Ultrafast Landing Page',
			'd' => 'A standalone landing page crafted specifically for a high-ad-spend digital marketing campaign. Designed with sticky urgency callouts and fast mobile rendering.',
			'res' => array( '99 Mobile PageSpeed Score', 'High Ad CTR Conversion', 'Zero Layout Shifts' ),
			'stack' => array( 'HTML5', 'Tailwind CSS', 'JavaScript' ),
		),
	);
}

/** Load CSS/JS only on pages that use the shortcode. */
function dsw_enqueue() {
	wp_enqueue_style( 'dsw-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'dsw-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
	wp_enqueue_style( 'dsw-style', DSW_URL . 'assets/style.css', array( 'dsw-fonts', 'dsw-fa' ), DSW_VER );
	wp_enqueue_script( 'dsw-script', DSW_URL . 'assets/script.js', array(), DSW_VER, true );
	wp_localize_script( 'dsw-script', 'DSW', array( 'contact' => home_url( '/contact/' ) ) );
}

function dsw_shortcode() {
	dsw_enqueue();
	$cats = dsw_categories();

	ob_start();
	?>
	<section class="dsw" id="portfolio">
		<div class="dsw-head">
			<div class="dsw-filters" id="dsw-filters" role="group" aria-label="Filter projects">
				<button type="button" class="on" data-f="all">All</button>
				<?php foreach ( $cats as $key => $label ) : ?>
					<button type="button" data-f="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="dsw-grid" id="dsw-grid">
			<?php foreach ( dsw_projects() as $p ) : ?>
				<article class="dsw-card" data-cat="<?php echo esc_attr( $p['cat'] ); ?>">
					<div class="dsw-media">
						<img src="<?php echo esc_url( dsw_image_url( $p['img'] ) ); ?>" alt="<?php echo esc_attr( $p['n'] ); ?> website" loading="lazy" decoding="async">
						<span class="dsw-badge"><?php echo esc_html( $p['badge'] ); ?></span>
						<div class="dsw-ov">
							<button type="button" data-open>Case Study</button>
							<a href="<?php echo esc_url( $p['u'] ); ?>" target="_blank" rel="noopener noreferrer">Visit Site</a>
						</div>
					</div>
					<div class="dsw-body">
						<span class="dsw-chip"><?php echo esc_html( $p['chip'] ); ?></span>
						<h3><?php echo esc_html( $p['n'] ); ?></h3>
						<p><?php echo esc_html( $p['s'] ); ?></p>
						<div class="dsw-foot">
							<span class="dsw-metric"><i class="fa-solid <?php echo esc_attr( $p['icon'] ); ?>"></i><?php echo esc_html( $p['foot'] ); ?></span>
							<button type="button" data-open>Details <i class="fa-solid fa-arrow-right"></i></button>
						</div>
					</div>
					<div class="dsw-detail" hidden>
						<p class="dsw-sub"><?php echo esc_html( $p['sub'] ); ?></p>
						<p class="ov"><?php echo esc_html( $p['d'] ); ?></p>
						<?php if ( ! empty( $p['res'] ) ) : ?>
							<ul>
								<?php foreach ( $p['res'] as $r ) : ?>
									<li><?php echo esc_html( $r ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<?php if ( ! empty( $p['stack'] ) ) : ?>
							<div class="dsw-stack">
								<?php foreach ( $p['stack'] as $t ) : ?>
									<span><?php echo esc_html( $t ); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<div class="dsw-modal" id="dsw-modal" aria-hidden="true">
		<div class="dsw-dialog" role="dialog" aria-modal="true" aria-labelledby="m-title">
			<button type="button" class="dsw-x" id="dsw-close" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
			<div id="dsw-body"></div>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'devscripty_portfolio', 'dsw_shortcode' );
