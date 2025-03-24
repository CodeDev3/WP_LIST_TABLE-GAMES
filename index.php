<?php
/*
Plugin Name:Games
Plugin URI : https://example.com/game-management-system
Description:Plugin to  manage all players data
Author:Divyank
Version:1.0.0
Author URI: http://yourdomain.com
License: GPL2
*/

define("GAME_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("GAME_PLUGIN_URL", plugin_dir_url(__FILE__));

include_once GAME_PLUGIN_PATH . 'class/games.php';

$Object = new GamesManagement();

register_activation_hook(
    __FILE__,
    array(
        $Object,
        "CREATE_TABLE"
    )
);

// register_deactivation_hook(
//     __FILE__,
//     array(
//         $Object,
//         "DROP_TABLE"
//     )
// );







