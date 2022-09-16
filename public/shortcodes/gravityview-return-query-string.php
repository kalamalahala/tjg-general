<?php


/**
 * This is specifically to maintain the query string when returning from a GravityView entry in the Quality Portal
 */
function return_query_string() {
    $q_string = $_SERVER['QUERY_STRING'];
    return $q_string;
}