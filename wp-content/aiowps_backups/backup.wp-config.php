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
define('DB_NAME', 'bite');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'raccoon');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', 'utf8_bin');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'u>Bn>P =ItM$Kk;!$E5B>1|Il}.FhAHvQ(`AT;%5Yu=l;|8caFE7`:jK>%A6q76F');
define('SECURE_AUTH_KEY',  '-7 hr=%76 ^d4w&A7CE78?G20#L~1&Pi~MQif>Ew?s-(JUucb&!(w^{meFu>@h,W');
define('LOGGED_IN_KEY',    'yrW^lwZi+`.< sFq6Ew/$d/w{4Ycflhnpe/zjBk&ZPBSKSv:/6/Qh.Dp Exu_uCd');
define('NONCE_KEY',        '9D`hlFfN %K|U;iBm!%PTgyHu12I]g$a:ts cDJ>:]GP&em-~HSl:?Ht|/uv_m*u');
define('AUTH_SALT',        'iC+YI}m7`(bNi/dHF7[?h+7@boTQ<Kp*Dr9{%n1sR<299Nk|(n/{{ju`=p]d/M4r');
define('SECURE_AUTH_SALT', 'wfC`{GRPq;-9uSMF+#E;.$wfKw?k4cl+|}f8*&d0v~qC#Xrw-xEm)96dQZch}Sn/');
define('LOGGED_IN_SALT',   'w+HI`5n#%aI+V&<Kw8sXeTn/l[]U.O1-~PA{hem-5H/v91#CMC;;xXhDRoh|yE-m');
define('NONCE_SALT',       '|--<OzNZBb=wgE4:N-op[c3TN6rz2|d)l(OG|^6n&KSt-H(Z1YW{]q;o_:T.?x/@');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'evtxp_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
