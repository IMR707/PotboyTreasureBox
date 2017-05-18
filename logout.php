<?php
  define("_VALID_PHP", true);

  require_once("init.php");
?>
<?php
  if ($user->logged_in)
      $user->logout();
      if(isset($_SERVER['HTTP_REFERER'])){
        redirect_to($_SERVER['HTTP_REFERER']);
      }
      redirect_to('index.php');

?>
