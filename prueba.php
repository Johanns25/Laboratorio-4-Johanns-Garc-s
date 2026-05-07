<?php

use App\User;
use Database\Model\ProductModel;

require 'vendor/autoload.php';

$user = new User();

echo $user->getName();
echo "\n";
$products = new ProductModel();

echo $products->getId();