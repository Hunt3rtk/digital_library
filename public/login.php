
<?php

$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
    if(empty($errors)) {
        // Using one variable ensures that msg is the same
        $login_failure_msg = "Log in was unsuccessful.";

        $user = find_user_by_username($username);
        if($user) {
          // password match
          if (validate_password($user->get_id(), $password)) {
            log_in_user($user);
            redirect_to(url_for('/private/index.php?user_id='.$user->id));
          } else {
            $errors[] = $login_failure_msg;
          }
        }
    }
}

?>

<?php $page_title = 'Log in'; ?>

<style>
  body {
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--van-dyke);
    font-weight: 700;
  }
  div {
    text-align: center;
    padding: 7%;
    background-color: var(--cambridge-blue);
    border: 5px solid var(--timberwolf);
    border-radius: 12px;
    box-shadow: 7px 7px 5px 5px var(--shadow);
  }
  form {
    line-height: 3;
  }

  h1 {
    letter-spacing: 5;
    padding: 10px;
    background-color: var(--timberwolf);
    color: var(--van-dyke);
    border: 2px solid var(--van-dyke);
    border-radius: 5px;
  }

  #submit {
    width: 120px;
    height: 40px;
    color: var(--timberwolf);
    background-color: var(--chestnut);
    border-radius: 20px;
    border: none;
    padding: 0;
    cursor: pointer;
    outline: inherit;
    box-shadow: 5px 5px var(--shadow);
  }

  #submit:hover {
    border-radius: 40px;
    box-shadow: 7px 7px 5px 5px var(--shadow);
  }

  input {
    height: 4%;
    border: 1px solid var(--van-dyke);
    border-radius: 5px;
    background-color: var(--timberwolf);
  }


</style>

<div>
  <h1>LOGIN</h1>

  <?php echo display_errors($errors); ?>

  <form action="../digital_library/index.php" method="post">
    USERNAME<br />
    <input type="text" name="username" value="<?php echo h($username); ?>" /><br />
    PASSWORD<br />
    <input type="password" name="password" value="" /><br />
    <br />
    <input id="submit" type="submit" name="submit" value="Submit"  />
    <input type="hidden" name="action" value="login">
  </form>

</div>
