<?php
if(!class_exists('PlayersListTable'))
{
    include_once GAME_PLUGIN_PATH . 'class/PlayersListTable.php';
}

$table= new PlayersListTable();
echo '<div class="container d-flex justify-content-end mt-4">';
echo '<a class="btn btn-primary" href="http://localhost/project/wp-admin/admin.php?page=game"> + Add Employee</a>';
echo '</div>';

echo '<div class="wrap">';
echo '<h1 class="text-center">List of Players</h1>';

$table->prepare_items();

echo '<form method="GET" id="form_search">';
echo '<input type="hidden" name="page" value="all-player">';


//add search box
$table->search_box("Search Player", "search_player");

//display records
$table->display();

echo '</form>';

echo '</div>';
?>