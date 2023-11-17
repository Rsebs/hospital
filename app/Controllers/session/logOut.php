<?php
include '../../../includes/urls.php';

session_start();
session_destroy();

header("location: $urlLogin");
