<?php

  // BOOKS

  // Find all books,
  function find_all_books($orderby = "id", $order = "ASC") {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT * FROM books ";
    $sql .= " ORDER BY " . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new Book();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_author($r['author']);
      $temp->set_description($r['description']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);

    return $books;
  }

  // Find book by id
  function find_book_by_id($id) {
    global $db;

    $sql = "SELECT * FROM books ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $result = mysqli_fetch_assoc($result); // find first
    $book = new Book();
    $book->set_id($result['id']);
    $book->set_title($result['title']);
    $book->set_author($result['author']);
    $book->set_description($result['description']);
    return $book; // returns an Book object
  }

  function search_discover($query, $orderby = "id", $order = "ASC") {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT * FROM books
    WHERE  books.title LIKE '%" . db_escape($db, $query) . "%' OR books.author LIKE '%" . db_escape($db, $query) . "%'
    ORDER BY" . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new Book();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_author($r['author']);
      $temp->set_description($r['description']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);

    return $books;
  }

  // LIBRARY

  // Find all books in library for user
  function find_library_of_user_id($user_id, $orderby = "id", $order = "ASC") {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT books.id, books.title, books.description, library.rating, library.comment FROM books INNER JOIN library
    ON books.id=library.book_id
    WHERE library.user_id='" . db_escape($db, $user_id) . "'
    ORDER BY " . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new PersonalBook();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_description($r['description']);
      $temp->set_comment($r['comment']);
      $temp->set_rating($r['rating']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);
    return $books;
  }
  
  function find_avg_book_rating($book_id) {
    global $db;

    $sql = "SELECT AVG(library.rating) FROM library 
    WHERE library.book_id='" . db_escape($db, $book_id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function update_comment($comment, $book_id, $user_id) {
    global $db;

    $sql = "UPDATE library SET library.comment = '" . db_escape($db, $comment) . "' 
    WHERE library.book_id = '" . db_escape($db, $book_id) . "'  AND library.user_id = '" . db_escape($db, $user_id) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function update_rating($rating, $book_id, $user_id) {
    global $db;

    $sql = "UPDATE library SET library.rating = '" . db_escape($db, $rating) . "' 
    WHERE library.book_id = '" . db_escape($db, $book_id) . "'  AND library.user_id = '" . db_escape($db, $user_id)  . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function add_book_to_library($book_id, $user_id) {
    global $db;

    $sql = "INSERT INTO library (book_id, user_id)
    VALUES ( '" . db_escape($db, $book_id) . "', '".db_escape($db, $user_id) . "')";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function delete_book_from_library($book_id, $user_id) {
    global $db;

    $sql = "DELETE FROM library
    WHERE  book_id='" . db_escape($db, $book_id) . "' " . "AND user_id='" . db_escape($db, $user_id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function search_library($query, $orderby = "id", $order = "ASC", $user_id) {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT * FROM books INNER JOIN library
    ON books.id=library.book_id
    WHERE  books.title LIKE '%" . db_escape($db, $query) . "%' AND user_id='" . db_escape($db, $user_id) . "' OR books.author LIKE '%" . db_escape($db, $query) . "%' AND user_id='" . db_escape($db, $user_id) . "'
    ORDER BY " . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new PersonalBook();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_description($r['description']);
      $temp->set_comment($r['comment']);
      $temp->set_rating($r['rating']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);
    return $books;
  }

  // BOOKMARKLIST

  // Find all books in boomarklist for user
  function find_bookmarked_of_user_id($user_id, $orderby = "id", $order = "ASC") {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT books.id, books.title, books.description FROM books INNER JOIN bookmarklist
    ON books.id=bookmarklist.book_id
    WHERE bookmarklist.user_id='" . db_escape($db, $user_id) . "'
    ORDER BY " . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new Book();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_description($r['description']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);

    return $books;
  }

  function delete_book_from_bookmarklist($book_id, $user_id) {
    global $db;

    $sql = "DELETE FROM bookmarklist
    WHERE  book_id='" . db_escape($db, $book_id) . "' " . "AND user_id='" . db_escape($db, $user_id) . "' ";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    
    return $result;
  }

  function search_bookmarked($query, $orderby = "id", $order = "ASC", $user_id) {
    global $db;
    if($orderby == null) {$orderby = "id";}
    if($order == null) {$order = "ASC";}
    $sql = "SELECT * FROM books INNER JOIN bookmarklist
    ON books.id=bookmarklist.book_id
    WHERE  books.title LIKE '%" . db_escape($db, $query) . "%' AND user_id='" . db_escape($db, $user_id) . "' OR books.author LIKE '%" . db_escape($db, $query) . "%' AND user_id='" . db_escape($db, $user_id) . "'
    ORDER BY " . db_escape($db, $orderby) . " " . db_escape($db, $order);
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $books = [];
    foreach($result as $r) {
      $temp = new Book();
      $temp->set_id($r['id']);
      $temp->set_title($r['title']);
      $temp->set_description($r['description']);
      array_push($books, $temp);
    }
    mysqli_free_result($result);

    return $books;
  }

  // USERS

  // Find all users,
  function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY user ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $users = [];
    foreach($result as $r) {
      $temp = new User();
      $temp->set_id($r['id']);
      $temp->set_username($r['username']);
      $temp->set_password($r['password']);
      $temp->set_email($r['email']);
      $temp->set_current_book_id($r['current_book_id']);
      array_push($users, $temp);
    }
    mysqli_free_result($result);
    return $users;
  }

  function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $result = mysqli_fetch_assoc($result); // find first
    $user = new User();
    $user->set_id($result['id']);
    $user->set_username($result['username']);
    $user->set_password($result['password']);
    $user->set_email($result['email']);
    $user->set_current_book_id($result['current_book_id']);
    return $user; // returns an User object
  }

  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, h($username)) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $result = mysqli_fetch_assoc($result); // find first
    $user = new User();
    $user->set_id($result['id']);
    $user->set_username($result['username']);
    $user->set_password($result['password']);
    $user->set_email($result['email']);
    $user->set_current_book_id($result['current_book_id']);
    return $user; // returns an User object
  }

  function validate_password($user_id, $password) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $user_id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $result = mysqli_fetch_assoc($result); // find first
    if ($result['password'] == h($password)) { return true; } else { return false; }
  }


  function validate_user($user, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($user->get_email())) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user->get_email(), array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user->get_email())) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($user->get_username())) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user->get_username(), array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user->get_username(), $user->get_id() ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($user->get_password())) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($user->get_password(), array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $user->get_password())) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $user->get_password())) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $user->get_password())) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user->get_password())) {
        $errors[] = "Password must contain at least 1 symbol";
      }
    }

    return $errors;
  }

  function insert_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $password = $user['password'];

    $sql = "INSERT INTO users ";
    $sql .= "(email, username, password) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $user['email']) . "',";
    $sql .= "'" . db_escape($db, $user['username']) . "',";
    $sql .= "'" . db_escape($db, $password) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_user($user) {
    global $db;

    $password_sent = !is_blank($user['password']);

    $errors = validate_user($user, ['password_required' => $password_sent]);
    if (!empty($errors)) {
      return $errors;
    }

    $password = $user['password'];

    $sql = "UPDATE users SET ";
    $sql .= "email='" . db_escape($db, $user['email']) . "', ";
    if($password_sent) {
      $sql .= "password='" . db_escape($db, $password) . "', ";
    }
    $sql .= "username='" . db_escape($db, $user['username']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function delete_user($user) {
    global $db;

    $sql = "DELETE FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $user['id']) . "' ";
    $sql .= "LIMIT 1;";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

?>
