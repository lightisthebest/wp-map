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
define( 'DB_NAME', 'wp-map' );

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
define('AUTH_KEY',         'VTD/cYXBsfR0aYX3>>/G:%oU^86^w!v]Dq2K5KELbY>9Ng~m;aRFv~nkL<!AT|C@');
define('SECURE_AUTH_KEY',  '_>gShjg:P#-80LC|{R~EWGOm|Mb:8MMvT9VFq&d[M-U#7|q[mlA%RpKS5w#94ry]');
define('LOGGED_IN_KEY',    '+)Ii5q-n[(z>[BGrKo{zqP>5F|+y]d/M7$,<B#S_d6><+z+|_j]ND|1d8DuF6^,.');
define('NONCE_KEY',        'fz,r|>-,(Xs1-#~Wx}I|[g|ci4v-)x{T3/)4%g5RC|sl5D`AH}ih&{x|u+F|Z(-6');
define('AUTH_SALT',        '/xnZonP28,Z8^}|-T?G9|mSP|J4ZrQ|?17cDIzuXcD1xM}J-L4VOhuDj96(C=:-v');
define('SECURE_AUTH_SALT', 'YSDjrr^~N>(}D!S`j)w)f[/J%pQECkV#*7t~:] P/i/TA2&%84V4z^U=y3&@vNXW');
define('LOGGED_IN_SALT',   'qIE&7oeDO+js#^j70sQ|RvV.^yKoXvAmIH+ -_{]8CF6WCMBxZ8:hU~*f+$Gzg%t');
define('NONCE_SALT',       '+~+a)Pb|Pz&#k|AmcRSi$tBL&)?sg$PIF8}pS.TD;B2yi2 ;0-7G}--V%cW~M#rW');

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
