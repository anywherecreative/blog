<?php
require('config.php');
$conf = new Configuration();
require('user.class.php');
//create a test user
$testUser = new User("jeff","testing",true);
?>