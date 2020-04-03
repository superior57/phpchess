<?php
////////////////////////////////////////////////////////////////////////
//Configuration file for the phpChess
////////////////////////////////////////////////////////////////////////

$conf['database_host'] = "localhost";
$conf['database_name'] = "phpchess";
$conf['database_login'] = "root";
$conf['database_pass'] = "";

$conf['site_name'] = "";
$conf['site_url'] = "http://localhost/";
$conf['registration_email'] = "petpanda0057@gmail.com";

$conf['session_timeout_sec'] = 3600;

$conf['password_salt'] = "L+hkz&c3[T4])#6";

$conf['new_user_requires_approval'] = true;

$conf['chat_refresh_rate'] = 10;

$conf['absolute_directory_location'] = "E:/current_project/freelancer.com/ilfat/pucharse/phpchess-master/";

$conf['avatar_absolute_directory_location'] = "E:/current_project/freelancer.com/ilfat/pucharse/phpchess-master/avatars\\";
$conf['avatar_image_disk_size_in_bytes'] = 102400;
$conf['avatar_image_width'] = 100;
$conf['avatar_image_height'] = 100;

$conf['view_chess_games_refresh_rate'] = 30;		// Number of seconds between updates when viewing games available.
$conf['last_move_check_rate'] = 10;			// Number of seconds between new move checks in realtime games.

?>