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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'jikescw' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '741852963Qaz' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'dbl@WHCS!NW1NW39(+U<?kTgn+ aK%F0ZmVD0szmuVt)[0S6S#?!_1O>8M%LWUki' );
define( 'SECURE_AUTH_KEY',  'Kn2;*Q,:19NoonUSP,PwGw10Q$Ra.)PC&HzLc5n=RL?yz}0+V (65?<_Ec12.0LC' );
define( 'LOGGED_IN_KEY',    ' G4!8aqm-@7Od.f<5(&aDYl^+lFR)j9*Vo*;kr/J$DiD~zRs;D-;:2;h4f^B,_:~' );
define( 'NONCE_KEY',        '*Q5QzRw,78$r?8nuU}X}rXSsm70*KZ5J71SjkJqf!3v5)u&_mS!xCaV9LWJH~v2&' );
define( 'AUTH_SALT',        '9cLBWF;51MJ5F/aywx?BWx]c6&||{Bqosg&tB$g#[0aA=FTS[*97VRn>*k#` -2y' );
define( 'SECURE_AUTH_SALT', 'tyM&:X=Z[2._(;WDz2Xyi TApsBHd?*lu;iY3F+LH}}t1|6%a`QeB` <#]eJl~^D' );
define( 'LOGGED_IN_SALT',   'x Rh/&a|AU!Hg%K{<Mj}SOsPJ#b]F)a@~jArMy_D*UEZ^ny(.&a@Cou!U>R,?,@0' );
define( 'NONCE_SALT',       's}o75x|zC[QyD<xOQ7-zy,+hX*wbE2*;4s@_0.P)?g??A.&:ktqkQ[>$S]x#s^#A' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'scw_pic';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
