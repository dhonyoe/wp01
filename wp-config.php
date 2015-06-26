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
define('DB_NAME', 'wp_01');

/** MySQL database username */
define('DB_USER', 'jd');

/** MySQL database password */
define('DB_PASSWORD', 'jd');

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
define('AUTH_KEY',         'Ut}r%-gL/-o;`I<Ij|h|wLpW3))uU/c`%bC+m8>F^p_WDE?LD1LgxLc/Xh)e.&Yt');
define('SECURE_AUTH_KEY',  '?P+k+y1(mu^*M7h1GpMH9.Y({~y1V/||<01}WcCqsZ<80t$?;u@1MqjCj&-pskkL');
define('LOGGED_IN_KEY',    'FLC<P?P$v%o[RDwWNjChhUPT^7|jhOERI+ouqlT|Fq;9?-LGQ *$D96&[*TpQW82');
define('NONCE_KEY',        '<U!DZ3Z}{|:^2iG$6|)#+hZ3~=?&6}J@Y]*hn-(v_@z&p3xX+*dM/Ej2?N+=CK4-');
define('AUTH_SALT',        ')$c-[1M}0W+SJRp.2Pg>$+[Is|]7,czkqV2HCo;v<p[g-:^6[#2_*sH=Odv3(2!W');
define('SECURE_AUTH_SALT', 'Evg:&&gCS!4{er-~FT{+cxjTLDZ:tiys+{1/g$@JLCAoDjB@Tn(x+.d-=0h=>JuY');
define('LOGGED_IN_SALT',   '!hxo9t.2Q)F|Px1K/gf#-eA{;<Q_4Ra/KCO>)vKXu4!W{&jTt!YUk,XD2bN.xXs!');
define('NONCE_SALT',       '!D_-GuR1%tD67<J{-9]_Jk4wse}s~l.m:I%C~xo!qGES9XWbL|t{2-KT5:?1Q6[>');

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

define('DISALLOW_FILE_EDIT',  TRUE);


define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/dev/jd/github/wp01/_content');
define('WP_CONTENT_URL', 'http://127.0.0.1/dev/jd/github/wp01/_content');

define('WP_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/dev/jd/github/wp01/_content/plugins');
define('WP_PLUGIN_URL', 'http://127.0.0.1/dev/jd/github/wp01/_content/plugins');
define('PLUGINDIR', $_SERVER['DOCUMENT_ROOT'].'/dev/jd/github/wp01/_content/plugins');

define('LOGIN_PAGE', 'secure_login');


/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


// Your panic codes are: 15175274, 57997778, 76266416