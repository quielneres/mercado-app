<?php

require 'config.php';

require 'vendor/autoload.php';

use app\models\Database;

// initialize Illuminate database connection
new Database();
