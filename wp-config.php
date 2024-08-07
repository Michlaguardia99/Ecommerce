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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'WP' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'iYfhZHcbCsBk2I5ojCvonauqFa4o6OMB4Ai9JNFugbXPm0lPvKe1XftVSbALx2mb' );
define( 'SECURE_AUTH_KEY',  'xD0w7aXNY5kXXh2xpAjOd2t0dHn0OEX8rJll5NfnPIhMCPKv7X3Kz1yLz4Gj83Cj' );
define( 'LOGGED_IN_KEY',    'jiZtsd6wNQBzGy1lkq7QbNMEVP1HeXKxq4PjPDLBhs8TiyXyCfn0lJfXJCGHp4IV' );
define( 'NONCE_KEY',        'TYMZro0YjFwCNvAqxPAEfkz2C8XLV3yCWt6adP97I4QAtHVTvrOIDhO3pAXmBKuL' );
define( 'AUTH_SALT',        'qZTmCgx2IbEun3GeQqXJ38aGZ0mFII2fCUWZN07l0Wv8Oj9YxVWk761oBGZqpYvk' );
define( 'SECURE_AUTH_SALT', '3v2XZ6sGhFX8fdvWveZUgxxTRA6jS1u4xOpnAiEXAUKnodXqmY3mj1hOw6TShoFN' );
define( 'LOGGED_IN_SALT',   'MlwPXuKc4MP0dgf8YFeA5rgxozWhP8DK7EGOWcY53i5VEaimXpIiamhErdguTGnM' );
define( 'NONCE_SALT',       'KYpcIqWbdtslzQCGAXmPUt8b7wgiYDrwzSoR5FE1vb3sPuM87NVyof8Y5mYCk4N0' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
