<?php

// date_default_timezone_set('Asia/Ho_Chi_Minh');
const BASE_URL = 'http://192.168.1.6/Speaker';

function isGet() {
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        return true;
    }
    return false;
}

function isPost() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        return true;
    }
    return false;
}

?>