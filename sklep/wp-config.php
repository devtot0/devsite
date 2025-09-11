<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'foxmedia_sklep' );

/** MySQL database username */
define( 'DB_USER', 'foxmedia_sklep' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ThGqhZV5YQ' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'i48Z%+N`D>ZUq7:k(l IBt/S1yBv#x+J.<x gnEATs`XEV4#Q9DUs+:`:%H_^G:>' );
define( 'SECURE_AUTH_KEY',  'sX X},oNW]6{lqm5SA!_kzGYXhwVK4>]>&$kW&T3T(hcs;h=]UfG6Y0@XcxwUsd`' );
define( 'LOGGED_IN_KEY',    '?`5XUW!D*E7$VgXA90H1#;KPo&wk/WiMf?wrSr9^1&Ojw+~a<ri/&b!Fr(/0m2iE' );
define( 'NONCE_KEY',        '>P:4}hjgDBp7.=>68 wwk7=zHpYTV#I7(+-o^Qe75 xX&u.eEqcTxH6VjWMol* W' );
define( 'AUTH_SALT',        ']PLZAemgx$q:?y`9W7t-5V g`WJaEuKBR@0aFCfvUF492 N`3xrdSD;+Y]tKsKsJ' );
define( 'SECURE_AUTH_SALT', '2a5ul$SrmC6J`G7pjR0678mE:T`h{&/IR9oc9q(cLo<P6eE6rxq`#16 XTlkN$Ue' );
define( 'LOGGED_IN_SALT',   'w|W<.p6;,ry*:g+tHH,~%PA%Bt}O58N~x(G^N??a jYI8@Bg? PKq+@Ew(}<Cwup' );
define( 'NONCE_SALT',       '|9^)S~|)<7i$^3/(1=/i5jVWuh@$Db7`JZLSki3L`T|OVbpJbZC@hHB5J5K=@sM:' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
