<?php

if(ENV == 1) error_reporting(0);
if(ENV == 2){
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
}