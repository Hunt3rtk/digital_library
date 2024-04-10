
<link rel="stylesheet" href="css/stylesheet.css">
<?php 

require_once 'private/initialize.php';

$action = filter_input(INPUT_POST,"action");
    if ($action == NULL) {
        $action = filter_input(INPUT_GET,"action");
        if ($action == NULL) {
            $action = 'home_page';
        }
    }

if (is_logged_in()) {
    log_out_user();
}

if ($action == 'home_page') {
    include (PUBLIC_PATH . '/home_page.php');
} else if ($action == 'login') {
    include (PUBLIC_PATH . '/login.php');
}
?>

<?php db_disconnect($db); ?>