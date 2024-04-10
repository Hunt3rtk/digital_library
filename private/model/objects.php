<?php 

class User {

    public $id;

    public $username;

    public $password;

    public $email;

    public $current_book_id;


    function get_id() {
        return $this->id;
    }
    function set_id($id) {
        return $this->id = $id;
    }
    function set_username($username) {
        $this->username = $username;
      }
    function get_username() {
        return $this->username;
    }

    function set_password($password) {
        $this->password = $password;
    }
    function get_password() {
        return $this->password;
    }
    
    function set_email($email) {
        $this->email = $email;
    }
    function get_email() {
        return $this->email;
    }

    function set_current_book_id($current_book_id) {
        $this->current_book_id = $current_book_id;
    }
    function get_current_book_id() {
        return $this->current_book_id;
    }
}

class Book {
    public $id;

    public $title;

    public $author;

    public $description;

    
    function get_id() {
        return $this->id;
    }
    function set_id($id) {
        return $this->id = $id;
    }

    function get_title() {
        return $this->title;
    }
    function set_title($title) {
        return $this->title = $title;
    }

    function get_author() {
        return $this->author;
    }
    function set_author($author) {
        return $this->author = $author;
    }
    
    function get_description() {
        return $this->description;
    }
    function set_description($description) {
        return $this->description = $description;
    }
}

class PersonalBook extends Book {

    public $comment;

    public $rating;


    function get_comment() {
        return $this->comment;
    }
    function set_comment($comment) {
        return $this->comment = $comment;
    }
    function get_rating() {
        return $this->rating;
    }
    function set_rating($rating) {
        return $this->rating = $rating;
    }
}


?>