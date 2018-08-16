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
define('DB_NAME', 'seotmdev_alga');

/** MySQL database username */
define('DB_USER', 'seotmdev_alga');

/** MySQL database password */
define('DB_PASSWORD', 'cqde4765');

/** MySQL hostname */
define('DB_HOST', 'seotmdev.mysql.tools');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'XncRDo5F*DbWW6*QjIU7(kkkGY@#yvkErNQ&TSipyTAS@bvj8dZF0o&vyguuYL3y');
define('SECURE_AUTH_KEY',  'R&0u39a22F4H9Qbh@Gp)Dmnr(Cd9KHFf!FEKF#QiE6D4)qMlC0vm%GmW9m9y!66L');
define('LOGGED_IN_KEY',    'U#D8#jUjCiKOLBES0FRFh#jZmP0Lz1#fnZeyoILJ^*qSfBAbwML(awoq1m7)x#G5');
define('NONCE_KEY',        '#2JE&7zeQUa#qD5lYss0JTSaOMkzxVAVK9&K*WHpmwsgp^NuBfIQ(tAqiz@9POhw');
define('AUTH_SALT',        'QOvH9HI126B%3SGmkSHKw2PkhB0yquzM#KcXVLP#VdizmfaSSA)9zm^PYmGe@cIw');
define('SECURE_AUTH_SALT', '1m%mfhrD#tyjUN9rIud@XIo0O^JpGNmiCp*uhF2zpaRDv2swwt*D!UFelBT!cb&6');
define('LOGGED_IN_SALT',   'cX6GDDb6wUFA(VVQO@aojE1WS74FNHPS19KNRphA7qW2l0jG1w&O&qKNNj!PUBc%');
define('NONCE_SALT',       '6HfsruwFh8yj6ukHfuLUu*5xCa&Tp&fjI51Z@khyDSH4ql0o5jY0%yl7EbaZ@(fz');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

// log php errors
@ini_set('display_errors','On'); // enable or disable public display of errors (use 'On' or 'Off')

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
