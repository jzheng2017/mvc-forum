<?php

define('DEBUG', 'true');

define('DEFAULT_CONTROLLER', 'Index'); // default controller if there isn't one defined in the url
define('DEFAULT_LAYOUT', 'default'); // if no layout is set in the controller use this layout

define ('PROOT', '/mvc-forum/'); //set this to '/' for a live server

define('SITE_TITLE', 'Forum'); // this will be used if no site title is used

//define database constants
define('DB_NAME', 'forum');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1'); //for live servers use ip address to avoid DNS lookup

define('CURRENT_USER_SESSION_NAME', 'efaeDFasDSdAMKAsoiqxUqwou'); //session name for logged in user
define('REMEMBER_ME_COOKIE', 'ijqweoijAWeojiWiojeqeQIOH20198'); //cookie name for logged in user
define('REMEMBER_ME_COOKIE_EXPIRY', 2592000); // time in seconds for remember me cookie to live in (30 days)

define('ACCESS_RESTRICTED', 'RestrictedController'); //controller name for restricted redirect