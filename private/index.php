<link rel="stylesheet" href="../css/stylesheet.css">
<?php

require '../private/initialize.php';

/*      ----Controller----       */

if(!is_logged_in())
{
    redirect_to(PROJECT_PATH);
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

$book_id = filter_input(INPUT_POST,"book_id");
if ($book_id == NULL) {
    $book_id = filter_input(INPUT_GET,"book_id");
}

$add = filter_input(INPUT_POST,"add");
if ($add == NULL) {
    $add = filter_input(INPUT_GET,"add");
}
if ($add != NULL) {
    add_book_to_library($add, $user_id);
}

$comment = filter_input(INPUT_POST,"comment");
if ($comment == NULL) {
    $comment = filter_input(INPUT_GET,"comment");
}
if ($comment != NULL) {
    update_comment($comment, $book_id, $user_id);
}

$rating = filter_input(INPUT_POST,"rate");
if ($rating == NULL) {
    $rating = filter_input(INPUT_GET,"rate");
}
if ($rating != NULL) {
    update_rating($rating, $book_id, $user_id);
}

$search = filter_input(INPUT_POST,"search");
if ($search == NULL) {
    $search = filter_input(INPUT_GET,"search");
}

$orderby = filter_input(INPUT_POST,"orderby");
if ($orderby == NULL) {
    $orderby = filter_input(INPUT_GET,"orderby");
}

$order = filter_input(INPUT_POST,"order");
if ($order == NULL) {
    $order = filter_input(INPUT_GET,"order");
}


if ($search != NULL) {
    switch ($action) {
        case 'personal_library':
            $books = search_library($search, $orderby, $order, $user->get_id());
            break;
        case 'bookmarked_list':
            $books = search_bookmarked($search,  $orderby, $order, $user->get_id());
            break;
        case 'discover_list':
            $books = search_discover($search, $orderby, $order);
            break;
        default:
            break;
    }
} else {
    switch ($action) {
        case 'personal_library':
            $books = find_library_of_user_id($user->get_id(), $orderby, $order);
            break;
        case 'bookmarked_list':
            $books = find_bookmarked_of_user_id($user->get_id(), $orderby, $order);
            break;
        case 'discover_list':
            $books = find_all_books($orderby, $order);
            break;
        default:
            break;
    }
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
        <title>Digital Library</title>
    </head>
    <body>
        <?php include VIEW_PATH . '/nav.php';?>
        <?php include VIEW_PATH . '/header.php';?>

<?php

if ($action == 'personal_library') {
    include(VIEW_PATH . '/personal_library.php');
} else if ($action == 'bookmarked_list') {
    include(VIEW_PATH . '/bookmarked_list.php');
} else if ($action == 'discover_list') {
    include( VIEW_PATH . '/discover_list.php');
} else if ($action == 'logout') {
    log_out_user();
    redirect_to('../');
}
?>
    </body>
</html>

<?php db_disconnect($db); ?>