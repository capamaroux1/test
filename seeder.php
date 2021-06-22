<?php

require 'app/core/init.php';

$seeder = new app\seeder\UserSeeder();
$seeder->run();
