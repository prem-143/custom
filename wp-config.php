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
define( 'DB_NAME', 'selectedjewellery' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'gj-ij]< h;h2{@)6wmD A63 !}Jj!4,2_XIF@2gtx@W.o;xR!_0rnG@0ioojY8p~' );
define( 'SECURE_AUTH_KEY',  'B;zC5}<Zd<huJsFb/yi2`L__;2:Rs,mdzH0l:bnT6q{|_$WAXCPi.Y ~6gzjOwR-' );
define( 'LOGGED_IN_KEY',    'i+1H55gF,e,DC7Z^~48M/YqSCo2!~8]Q+rTTy/)td[nm3K+:`_.xs#fMEgr7X+u ' );
define( 'NONCE_KEY',        '{9*s$!z`TKCQ;E3LYrZ<goU/Q1h&K.l[,ZM+bgiv?YlnC>uftz=9+Y0ShL0_O U8' );
define( 'AUTH_SALT',        '=qoN{$6-nnYJt-h>HI|*6vQ$r(0*q;^CLU>WT?kxUT#0>*c,|@r?I0IpBUY07Vd8' );
define( 'SECURE_AUTH_SALT', '<z>_yS@NuzryE&W;e}-/j{n,{<`<P2d_ql1$kuL/m>NzvV3V#/Y8p2PA}swHoYJw' );
define( 'LOGGED_IN_SALT',   'o%YLpkx6ECH4g|s NI*.6/NR?*I){`0~&tBi>33)9wK(g8/56XXS=3lI5vn%q3T/' );
define( 'NONCE_SALT',       'P(tqR<Z<T_Q:hP+.eDslA}hCX`A]?RJtvyvK<voX.}x^VX Q!_>,M>z@LSaQ}E*V' );

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
