<?php
function send_email($recipient, $subject, $message, $name, $sender, $reply) {
  if($reply) $header = "From: $name <$sender> \r\n Reply-To: $sender \r\n X-Mailer: PHP/" . phpversion();
  else $header = "From: $name <$sender> \r\n X-Mailer: PHP/" . phpversion();
  mail($recipient, $subject, $message, $header);
}

function redirect($location) {
  header("Location: {$location}");
  exit;
}

define("IP_ADDRESS", $_SERVER["REMOTE_ADDR"]);
if(!in_array(IP_ADDRESS, array("127.0.0.1", "::1"))) {
  define("IS_LOCALHOST", false);
  $connection = mysqli_connect("localhost", "sewardsm_admin", "CaptainTommy1997", "sewardsm_signature");
} else {
  define("IS_LOCALHOST", true);
  $connection = mysqli_connect("localhost", "root", "", "sme") or die(); //DO NOT die IN PRODUCTION
}

session_start();
if(isset($_GET["sign-out"])) session_destroy();
if(isset($_SESSION["banner"])) $my_banner = $_SESSION["banner"];
if(isset($_SESSION["picture"])) $my_picture = $_SESSION["picture"];
if(isset($_SESSION["id"])) $my_id = $_SESSION["id"];
if(isset($_SESSION["signature"])) $my_sign = $_SESSION["signature"];
if(isset($_SESSION["email"])) $my_email = $_SESSION["email"];
?>
<!DOCTYPE html>
<html lang='en' dir='ltr'>
  <head>
    <?php echo IS_LOCALHOST ? "<base href='http://localhost/PHP-Hot-Pot/'>" : "<base href='https://sewards.me/'>"; ?>
    <meta charset='UTF-8'>
    <!--meta name='description' content='No description.'/-->
    <meta name='viewport' content='width = device-width, initial-scale = 1.0'/>
    <meta name='theme-color' content='#000'/>
    <!--meta http-equiv='Content-Security-Policy' content=''/-->
    <title>s.me <?php if(!empty($title)) echo " - " . $title; ?></title>
    <!--link rel='shortcut icon' href=''-->
    <link rel='stylesheet' type='text/css' href='css/variables.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/content.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/layouts.min.css'/>
    <link rel='stylesheet' type='text/css' href='css/components.min.css'/>
    <script type='text/javascript' src='js/simple.js'></script>
  </head>
  <body>
    <nav>
      <div>
        <a id='index-link' href='index.php'>Index</a>
        <a id='search-link' href='search.php'>Search</a>
        <a id='settings-link' href='settings.php'>Settings</a>
        <ul>
        </ul>
      </div>
      <div>
        <p>MySign</p>
        <div>
          <?php
          if(isset($my_sign)) {
            echo "<a id='dashboard-link' href='dashboard.php'>Dashboard</a>";
            //$url = str_replace("?sign-out", "", $_SERVER['REQUEST_URI']);
            //echo "<a id='sign-out-link' href='{$url}?sign-out'>Sign-out</a>";
          } else {
            echo "<a id='sign-in-link' href='sign-in.php'>Sign-in</a>";
            echo "<a id='sign-up-link' href='sign-up.php'>Sign-up</a>";
          }
          ?>
        </div>
      </div>
    </nav>