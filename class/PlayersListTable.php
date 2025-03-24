<?php
if (!class_exists("WP_List_Table")) {

    include_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}
class PlayersListTable extends WP_List_Table
{

    public function prepare_items()
    {
        global $wpdb;

        $tableName = $wpdb->prefix . 'games';

        $per_page = 4;

        $current_page = $this->get_pagenum();

        $offset = ($current_page - 1) * $per_page;
        $search_text = isset($_GET['s']) ? '%' .  $_GET['s'] . '%' : false;
        $orderBy= isset($_GET['orderby']) ?  $_GET['orderby']: 'id';
        $order= isset($_GET['order']) ?  $_GET['order']: 'DESC';

        $this->_column_headers = array($this->get_columns(),[],$this->get_sortable_columns());

        if ($search_text) {
            $totalPlayers = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$tableName}  WHERE `player_name` LIKE '$search_text'  ", ARRAY_A));
            $players = $wpdb->get_results("SELECT * FROM {$tableName} WHERE `player_name` LIKE '$search_text'  ORDER BY {$orderBy} {$order}  LIMIT {$offset}, {$per_page} ", ARRAY_A);
        } else {
            $totalPlayers = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$tableName} ", ARRAY_A));
            $players = $wpdb->get_results("SELECT * FROM {$tableName} ORDER BY {$orderBy} {$order}  LIMIT {$offset}, {$per_page} ", ARRAY_A);
        }


        $this->set_pagination_args(array(
            'total_items' => $totalPlayers,
            'total_pages' => ceil($totalPlayers / $per_page),
            'per_page'    => $per_page,
        ));

        $this->items = $players;
    }


    public function get_columns()
    {

        $columns = [
            "cb" => '<input type="checkbox" />',
            "player_name" => "Player Name",
            "category" => "Game",
            "player_email" => "Email",
            "player_address" => "Address",
            "player_dob" => "DOB"
        ];

        return $columns;
    }


    public function  get_sortable_columns()
    {
        $s_columns = array(
            'player_name' => ['id', true],
        );
        return $s_columns;

    }


    public function no_items()
    {
        echo "No Data Found";
    }


    public function column_cb($singlePlayer)
    {
        return isset($singlePlayer['id']) ?  '<input type="checkbox" value=' . $singlePlayer['id'] . '/>' : "N/A";
    }


    public function column_default($singlePlayer, $col_name)
    {
        return isset($singlePlayer[$col_name]) ?  $singlePlayer[$col_name] : "N/A";
    }

    public function column_player_dob($PlayerData)
    {
    $dob=$PlayerData['player_dob'];
    $newDate = date("m/d/Y", strtotime($dob));
    return $newDate;
    }
}
