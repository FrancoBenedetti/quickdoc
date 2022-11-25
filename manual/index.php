<?php
$docroot = $_SERVER['DOCUMENT_ROOT'];
$root = array_reverse(explode('/',$docroot))[0];
$path = explode('/',__FILE__);
$folder = $path[array_search($root, $path) + 1];
include "$docroot/$folder/quickdoc.php";
include "$docroot/$folder/template.php";
