<?php

class GamesManagement
{

    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'add_custom_menu'));
        add_action('wp_ajax_add_player', array($this, 'add_player_data'));
    }

    public function add_custom_menu()
    {
        add_menu_page(
            'Add Player',
            'Add Player',
            'manage_options',
            'game',
            array($this, 'add_player_page'),
            'dashicons-games',
            25
        );

        add_submenu_page(
            'game',
            'Add Player',
            'Add Player',
            'manage_options',
            'game',
            array($this, 'add_player_page'),
        );

        add_submenu_page(
            'game',
            'All Player',
            'All Player',
            'manage_options',
            'all-player',
            array($this, 'all_player_page'),
        );
    }

    public function add_player_page()
    {
        include_once GAME_PLUGIN_PATH . 'view/add_player.php';
    }

    public function add_player_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $playerName = isset($_POST['playerName']) ? $_POST['playerName'] : '';
            $playerEmail = isset($_POST['playerEmail']) ? $_POST['playerEmail'] : '';
            $playerDOB = isset($_POST['playerDOB']) ? $_POST['playerDOB'] : '';
            $playerGame = isset($_POST['playerGame']) ? $_POST['playerGame'] : '';
            $playerAddress = isset($_POST['playerAddress']) ? $_POST['playerAddress'] : '';

            if (empty($playerName) || empty($playerEmail) || empty($playerDOB) || empty($playerGame) || empty($playerAddress)) {
                wp_send_json_error(array('message' => 'Please fill All Details'));
            } else {

                global $wpdb;
                $tablename = $wpdb->prefix . 'games';
                $data = array(
                    'player_name' => $playerName,
                    'player_dob' => $playerDOB,
                    'player_address' => $playerAddress,
                    'category' => $playerGame,
                    'player_email' => $playerEmail,
                );

                $insert = $wpdb->insert($tablename, $data);
                if ($insert) {
                    wp_send_json_success(array('message' => 'Players Details Saved Successfully'));
                } else {
                    wp_send_json_error(array('message' => 'Error Player Details not saved'));
                }
            }
        }
        wp_die();
    }

    public function all_player_page()
    {
        ob_start();
        include_once GAME_PLUGIN_PATH . 'view/all_player.php';
        $content = ob_get_contents();
        ob_get_clean();
        echo $content;
    }


    public function enqueue_scripts()
    {
        if (@$_GET['page'] == 'game' || @$_GET['page'] == "all-player") {
            wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
            wp_enqueue_script('custom-js', GAME_PLUGIN_URL . 'assets/js/custom-js.js', array(), '1.0', true);
        }
    }

    public function CREATE_TABLE()
    {
        global $wpdb;
        $tablename = $wpdb->prefix . "games";
        $sql = "CREATE TABLE {$tablename} (
        `id` int(20) NOT NULL,
        `player_name` varchar(255) NOT NULL,
        `player_dob` date NOT NULL,
        `player_address` varchar(255) NOT NULL,
        `category` varchar(255) NOT NULL,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }


    public function DROP_TABLE()
    {
        global $wpdb;
        $tablename = $wpdb->prefix . "games";
        $wpdb->query("DROP TABLE IF EXISTS {$tablename}");
    }
}
