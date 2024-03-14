<?php

  // BOOKS

  // Find all books,
  function find_all_books() {
    global $db;

    $sql = "SELECT * FROM books ";
    $sql .= "ORDER BY title DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // Find book by id
  function find_book_by_id($id) {
    global $db;

    $sql = "SELECT * FROM books ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $book = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $book; // returns an assoc. array
  }


  // USERS

  // Find all users,
  function find_all_users() {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY user DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  function find_user_by_username($username) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $user; // returns an assoc. array
  }

  // LIBRARY

    // Find all books in library for user
    function find_library_of_user_id($user_id) {
      global $db;
  
      $sql = "SELECT books.id, books.title, books.description, library.rating, library.comment FROM books INNER JOIN library
      ON books.id=library.book_id
      WHERE library.user_id='" . db_escape($db, $user_id) . "' ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      
      return $result;
    }
    
    function find_avg_book_rating($book_id) {
      global $db;
  
      $sql = "SELECT AVG(library.rating) FROM library 
      WHERE library.book_id='" . db_escape($db, $book_id) . "' ";
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

  // BOOKMARKLIST

    // Find all books in boomarklist for user
    function find_bookmarked_of_user_id($user_id) {
      global $db;
  
      $sql = "SELECT books.id, books.title, books.description FROM books INNER JOIN bookmarklist
      ON books.id=bookmarklist.book_id
      WHERE bookmarklist.user_id='" . db_escape($db, $user_id) . "' ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      
      return $result;
    }

    function delete_book_from_bookmarklist($book_id, $user_id) {
      global $db;
  
      $sql = "DELETE FROM bookmarklist
      WHERE  book_id='" . db_escape($db, $book_id) . "' " . "AND user_id='" . db_escape($db, $user_id) . "' ";
      $result = mysqli_query($db, $sql);
      confirm_result_set($result);
      
      return $result;
    }

  function validate_user($user, $options=[]) {

    $password_required = $options['password_required'] ?? true;

    if(is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
      $errors[] = "Last name must be less than 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if(is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('min' => 8, 'max' => 255))) {
      $errors[] = "Username must be between 8 and 255 characters.";
    } elseif (!has_unique_username($user['username'], $user['id'] ?? 0)) {
      $errors[] = "Username not allowed. Try another.";
    }

    if($password_required) {
      if(is_blank($user['password'])) {
        $errors[] = "Password cannot be blank.";
      } elseif (!has_length($user['password'], array('min' => 12))) {
        $errors[] = "Password must contain 12 or more characters";
      } elseif (!preg_match('/[A-Z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      } elseif (!preg_match('/[a-z]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      } elseif (!preg_match('/[0-9]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 number";
      } elseif (!preg_match('/[^A-Za-z0-9\s]/', $user['password'])) {
        $errors[] = "Password must contain at least 1 symbol";
      }

      if(is_blank($user['confirm_password'])) {
        $errors[] = "Confirm password cannot be blank.";
      } elseif ($user['password'] !== $user['confirm_password']) {
        $errors[] = "Password and confirm password must match.";
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
