<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'futureclimate');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*&/ZM^Wu?Ec-$,%CYF_rd&9J5uDa*JlwxXW^^+3pgnUe+6TEsV5N|PoMhxiyrO%+');
define('SECURE_AUTH_KEY',  ']2l#^9pJ+rk#*vQP5.3(r&A_:B8fZ$%Bu:+wMIZfpu[ydjRiW*]5*e$w8k-M`=VB');
define('LOGGED_IN_KEY',    '][y?p{&l#3{Q)Q,y-|7hn2c*91%1KdT0Hk-b~bZEhS#UiL.`]$(u hnM`,@~a*/Y');
define('NONCE_KEY',        's:CCn/S>|c/nse]D@J=h(+us$yY-*ru^MqAjF)MN%#DV@-|eYfxD^``2C~cg!Ixf');
define('AUTH_SALT',        '{ :/sW:VqE%&3VAfqbCwpNhg$[N6jpG!R9+!aW8Gx7KOR0aen+c}Q#Iij]G2+e 9');
define('SECURE_AUTH_SALT', '{P::[2cT4u+p%Oq6d|u8d-33$&H_ 1-5=:;Dp.V5Hsd8lBvkq~?`6@pVWRe!L(Vp');
define('LOGGED_IN_SALT',   'DLBG^a_|9B$VI(vYKkl>2Ke%}M9;@[P]V6Pi.PbyGJ>R5i(NA_f%|TTDw+x]Q1[y');
define('NONCE_SALT',       't<}e/B6W~~,rvlU[:Zlb+3/C/q9..iM1bKcAPBnSz]C%UVcGPpB}l]l*@M//R+-/');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
