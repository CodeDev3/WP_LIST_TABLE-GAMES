# Games Management Plugin for WordPress

This WordPress plugin allows you to manage players' details for various games, including adding player data, viewing all players, and handling data storage in a custom database table.

## Features

- **Add Player**: A page for adding new players with their details such as name, email, date of birth, address, and game category.
- **View All Players**: A page that lists all players and allows searching, sorting, and pagination.
- **Player Data Management**: Allows storing player details in a custom database table, including validation and error handling.
- **Custom Database Table**: Creates and drops a table (`wp_games`) in the WordPress database for storing player information.

## Requirements

- WordPress 4.0 or higher
- PHP 7.0 or higher

## Installation

1. Download the plugin files and place them in the `wp-content/plugins/` directory of your WordPress installation.
2. Activate the plugin from the WordPress admin dashboard.

## How It Works

### 1. Custom Menu and Submenu

- The plugin adds a custom menu named **Add Player** to the WordPress admin sidebar.
- Under the **Add Player** menu, you can add new player details.
- A submenu for **All Player** allows you to view and manage a list of all players.

### 2. Adding Players

- On the **Add Player** page, you can enter the player’s name, email, date of birth, address, and game category.
- Data is saved in a custom table `wp_games` in the WordPress database.
- If all fields are filled out correctly, the player’s details will be saved. Otherwise, an error message will be shown.

### 3. Viewing All Players

- On the **All Player** page, all players' information is displayed in a paginated table.
- The table supports sorting by player name and allows for filtering through a search input.
- Players' details can be sorted based on different columns, such as name, game category, email, etc.

### 4. Custom Table

The plugin creates a table `wp_games` (or any table with the WordPress table prefix) in the database using the following structure:

```sql
CREATE TABLE wp_games (
    `id` int(20) NOT NULL AUTO_INCREMENT,
    `player_name` varchar(255) NOT NULL,
    `player_dob` date NOT NULL,
    `player_address` varchar(255) NOT NULL,
    `category` varchar(255) NOT NULL,
    `player_email` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


### 5. Scripts and Styles

-The plugin enqueues Bootstrap CSS for styling the admin pages.
-A custom JavaScript file is included to handle AJAX requests and form submissions.
