<?php

define('DB_HOST', 'mariadb');
define('DB_USER', getenv('MYSQL_USER'));
define('DB_PASS', getenv('MYSQL_ROOT_PASSWORD'));
define('DB_NAME', getenv('MYSQL_DATABASE'));
define('BASE_URL', getenv('BASE_URL'));
define('REST_BASE_URL', getenv('REST_BASE_URL'));
