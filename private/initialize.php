<?php
    /* Code From Kevin Skoglund's PHP with MySQL Essential Training */

  ob_start(); // output buffering is turned on

  session_start(); // turn on sessions

    // Assign file paths to PHP constants
  // __FILE__ returns the current path to this file
  // dirname() returns the path to the parent directory
  define("PRIVATE_PATH", dirname(__FILE__));
  define("PROJECT_PATH", dirname(PRIVATE_PATH));
  define("PUBLIC_PATH", PROJECT_PATH . '/public');
  define("VIEW_PATH", PRIVATE_PATH . '/view');
  define("MODEL_PATH", PRIVATE_PATH . '/model');

  // Assign the root URL to a PHP constant
  // * Do not need to include the domain
  // * Use same document root as webserver
  // * Can dynamically find everything in URL up to "/public"
  // $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
  // $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
  define("WWW_ROOT", '/digital_library');

  require_once(MODEL_PATH . '/functions.php');
  require_once(MODEL_PATH . '/database.php');
  require_once(MODEL_PATH . '/query_functions.php');
  require_once(MODEL_PATH . '/validation_functions.php');
  require_once(MODEL_PATH . '/auth_functions.php');
  require_once(MODEL_PATH . '/objects.php');

  $db = db_connect();
  $errors = [];
  $book_id = 0;
  $orderby = "id";
  $order = "DESC";

?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">