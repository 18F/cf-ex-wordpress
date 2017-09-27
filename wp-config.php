<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Read MySQL service properties from _ENV['VCAP_SERVICES']
$services = json_decode($_ENV['VCAP_SERVICES'], true);
$service = $services['aws-rds'][0];  // pick the first MySQL service

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $service['credentials']['db_name']);

/** MySQL database username */
define('DB_USER', $service['credentials']['username']);

/** MySQL database password */
define('DB_PASSWORD', $service['credentials']['password']);

/** MySQL hostname */
define('DB_HOST', $service['credentials']['host'] . ':' . $service['credentials']['port']);

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
 define('AUTH_KEY', $_ENV['AUTH_KEY']);
 define('SECURE_AUTH_KEY', $_ENV['SECURE_AUTH_KEY']);
 define('LOGGED_IN_KEY', $_ENV['LOGGED_IN_KEY']);
 define('NONCE_KEY', $_ENV['NONCE_KEY']);
 define('AUTH_SALT', $_ENV['AUTH_SALT']);
 define('SECURE_AUTH_SALT', $_ENV['SECURE_AUTH_SALT']);
 define('LOGGED_IN_SALT', $_ENV['LOGGED_IN_SALT']);
 define('NONCE_SALT', $_ENV['NONCE_SALT']);
/**#@-*/

/** S3 Uploads Keys **/
$s3service = $services['s3'][0]; // pick the first S3 service
define( 'S3_UPLOADS_BUCKET', $s3service['credentials']['bucket'] );
define( 'S3_UPLOADS_KEY', $s3service['credentials']['access_key_id'] );
define( 'S3_UPLOADS_SECRET', $s3service['credentials']['secret_access_key'] );
define( 'S3_UPLOADS_REGION', $s3service['credentials']['region'] );
define( 'S3_UPLOADS_BUCKET_URL', "https://s3-" . $s3service['credentials']['region'] . ".amazonaws.com/" . $s3service['credentials']['bucket'] );
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
