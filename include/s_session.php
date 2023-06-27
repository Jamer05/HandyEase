<?php
ini_set('session.use_only_cookies', 1); // Prevents the session ID from appearing in a referer header
session_set_cookie_params(0, '/', 'localhost', false, true); // Determines the duration of cookies
session_start(); // Start Session
session_regenerate_id(); // Regenerate Session ID 
?>