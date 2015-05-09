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
define('DB_NAME', 'jerry.blog');

/** MySQL database username */
define('DB_USER', 'jerry');

/** MySQL database password */
define('DB_PASSWORD', 'giaule');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1:3307');

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
define('AUTH_KEY',         '>a}|Y#[=yWy&F0TdTvq3j:&t/o-7$CODQscpQ8Z&i]Y$sM@e5z]Z`Al>TCXt>$C>');
define('SECURE_AUTH_KEY',  'c{`~Mx8:x&|5SEZ<,jI-qyjX*qG-B5/I1M+S&=RvY$[;KZ`%M)Vy`EYfg> WuU#8');
define('LOGGED_IN_KEY',    '<^J#|hJelrTE+{?d[:/?;!H{^{L`6+xI+!H5Cg:UcjxI!-]geC#xv2lJB[p_>DAb');
define('NONCE_KEY',        '@$P?]pP<S#-;VD@+*Z7CTq|;|Ep`$O}/=-9q-yE ta|@[?W?<A88sHT3]D%LR-|9');
define('AUTH_SALT',        'oUzQ5Ol&no9x:YW*S9Ov2E~,5ZEF(tP4Mi)-E}gbFKD<MWcWu+1^*KP48lYN`0Z%');
define('SECURE_AUTH_SALT', 'd1d&,Eu3-<OGPfy42-(/jq]E=:|6DK7#aGmK^g3D,6%w v|J~C&CjFt=U?Q6(J7d');
define('LOGGED_IN_SALT',   'sQ{coW?YV)aPV7KMwyfI,^,CX>--8{|v/:<]=-n*au~1bk,Eh!Tg&-pLCsjp4<I0');
define('NONCE_SALT',       '&`s+G&;IS[dgs6pmS?9!7)5yQj{hY[5:QHU)<#c0K+yLWcCg8&^n#Zg?qx1-oo(F');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'jb_';

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
