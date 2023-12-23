<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'lK0|_U&#&^mu*{#!<0PqSW1RBJE3|[fvS1X1eqo!M2?o-`HKc)3l@c)x~=Mr% Jw' );
define( 'SECURE_AUTH_KEY',   'F[vrM],E4ZLpK4Zv%8_j{Lhd=W8-D$^UmWaU|7|n?Dp| 6Wh|yc5,+uwD|Q_vgP2' );
define( 'LOGGED_IN_KEY',     '_11C$]FxvHx4v+0:3FiZU5KJ40}1t|x,rG>GwCx )4ZP_!$9B<edCK*n!>D*Q(d$' );
define( 'NONCE_KEY',         '|SIq0_TQP%t.i6yma-TwWjM07+&z/2ND@2Ndafb/5okg#@sD%X>HZ7fSxxDZRX~@' );
define( 'AUTH_SALT',         '/#JN>J4/8K~&Eh&v9MD^^FcEA$+V;8_rY,/ty>Rswm!UF)W,p=*bl/go:2g|V1;h' );
define( 'SECURE_AUTH_SALT',  '?y u,IKYk2C%r)u*{B4WVD{Rc[9s$xUUBA3CIN$JlAu),97~Z<{3zW1vU`s!z;V5' );
define( 'LOGGED_IN_SALT',    ':GEOh,}8y{Z!={kdMJrQ*)`PKWyxxoK[8!77RG*<MR*t*u?z0~8T<*]8Lre|Sw&g' );
define( 'NONCE_SALT',        'jX]m4mBq.F!p%A+kj*673(,S!;(wa-N9/Cf;3,7]?WK<bSwp}ubFWbn5L)sqQ15*' );
define( 'WP_CACHE_KEY_SALT', 'W <j*@-EO%?)[_M&3l`[|CuQsKM1w2c=&<edW~Ziii;>ej `tr1e8y)-(vS]WC%u' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
