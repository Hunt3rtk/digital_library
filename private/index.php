<link rel="stylesheet" href="../css/stylesheet.css">
<?php

require '../private/initialize.php';

/* Controller */

if(!is_logged_in())
{
    redirect_to('../');
}
$user_id = $_REQUEST['user_id'];
$user = find_user_by_id($user_id);

$action = filter_input(INPUT_POST,"action");
if ($action == NULL) {
    $action = filter_input(INPUT_GET,"action");
    if ($action == NULL) {
        $action = 'personal_library';
    }
}

$more = filter_input(INPUT_POST,"more");
if ($more == NULL) {
    $more = filter_input(INPUT_GET,"more");
    if ($more == NULL) {
        $more = 0;
    }
}


$add = filter_input(INPUT_GET,"add");
if ($add != NULL) {
    add_book_to_library($add, $user_id);
}

$delete_library = filter_input(INPUT_GET,"delete_library");
if ($delete_library != NULL) {
    delete_book_from_library($delete_library, $user_id);
}

$delete_bookmark = filter_input(INPUT_GET,"delete_bookmark");
if ($delete_bookmark != NULL) {
    delete_book_from_bookmarklist($delete_bookmark, $user_id);
}
?>
<html>
    <head>
        <title>Project</title>
    </head>
    <body>
        <?php include '../private/view/nav.php';?>
        <?php include '../private/view/header.php';?>

<?php

if ($action == 'personal_library') {
    include('personal_library.php');
} else if ($action == 'bookmarked_list') {
    include('bookmarked_list.php');
} else if ($action == 'discover_list') {
    include('discover_list.php');
} else if ($action == 'logout') {
    log_out_user();
    redirect_to('../');
}
?>
    </body>
</html>