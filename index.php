<!DOCTYPE html>
<?php
require('authenticate_google.php');

?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="assets/images/favicon/favicon.ico">
  <meta name="application-name" content="Newtelco Maintenance">
  <title>Newtelco Maintenance | Welcome</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="assets/images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="assets/images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
  <meta name="msapplication-TileColor" content="#67B246">
  <meta name="msapplication-TileImage" content="assets/images/favicon/ms-icon-144x144.png">
  <meta name="theme-color" content="#67B246">
  <link rel="manifest" href="manifest.json"></link>

  <link rel='stylesheet' href='assets/css/style.css'>
  <link rel='stylesheet' href='assets/css/dropdown.css'>

  <!-- font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!-- Google font-->
  <link prefetch rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,700" type="text/css">

  <!-- material design -->
  <link rel="stylesheet" href="assets/css/material.css">
  <script src="assets/js/material.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">

  <!-- moment -->
  <script src="assets/js/moment.js"></script>
  <script src="https://momentjs.com/downloads/moment-timezone-with-data.js"></script>

  <!-- pace -->
  <script src="assets/js/pace.js"></script>

  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>
<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header ">
      <header class="mdl-layout__header mdl-color--light-green-nt">
        <div class="mdl-layout__header-row">
          <a href="index.php"><img style="margin-right: 10px" src="assets/images/nt_square32_2_light2.png"/></a>
          <span class="mdl-layout-title">Maintenance</span>
          <div class="mdl-layout-spacer"></div>
          <div class="menu_userdetails">
            <button id="user-profile-menu" class="mdl-button mdl-js-button mdl-userprofile-button">
              <img class="menu_userphoto" src="<?php echo $token_data['picture'] ?>"/>
              <span class="mdl-layout-subtitle menumail"> <?php echo $token_data['email'] ?></span>
              <i class="fas fa-angle-down menuangle"></i>
            </button>
              <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                  for="user-profile-menu">
                <li class="mdl-menu__item">Some Action</li>
                <li class="mdl-menu__item">Another Action</li>
                <li disabled class="mdl-menu__item">Disabled Action</li>
                <a class="usermenuhref" href="?logout">
                  <li class="mdl-menu__item">
                    <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="#4e4e4e" d="M19,3H5C3.89,3 3,3.89 3,5V9H5V5H19V19H5V15H3V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3M10.08,15.58L11.5,17L16.5,12L11.5,7L10.08,8.41L12.67,11H3V13H12.67L10.08,15.58Z" />
                    </svg>
                    Logout
                  </li></a>
              </ul>
          </div>
        </div>
      </header>
      <?php
      if(isset($_POST['label']) || isset($_SESSION['label'])) {
        if(! empty($_POST['label'])) {
        $labelID = $_POST['label'];
        $_SESSION['label'] = $labelID;
        } else {
          $labelID = $_SESSION['label'];
        }
      } else {
        if(isset($_COOKIE['label'])) {
          $labelID = $_COOKIE['label'];
        } else {
          $labelID = '0';
        }
      }

      if ($labelID != '0') {
        $service3 = new Google_Service_Gmail($clientService);
        $results3 = $service3->users_labels->get($user,$labelID);


        $results4 = $service3->users_labels->get($user,'Label_6022158568059110610');
      }

      ?>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title"><img src="/assets/images/newtelco_black.png"/></span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="index.php"><span class="ndl-home"></span>  Home</a>
          <!-- <a class="mdl-navigation__link" href="userhome.php"><i class="ndl-face"></i>  <?php echo $token_data['name'] ?></a> -->
          <a class="mdl-navigation__link" href="overview.php"><i class="ndl-overview"></i>  Overview</a>
          <a class="mdl-navigation__link" href="incoming.php"><i class="ndl-ballot mdl-badge mdl-badge--overlap" data-badge="3"></i>  Incoming<div class="material-icons mdl-badge mdl-badge--overlap menuSubLabel2" data-badge="<?php if ($labelID != '0') { if ($results3['messagesTotal'] == 0) { echo "♥"; } else { echo $results3['messagesTotal']; }} else {  echo "♥"; } ?>"></div></a></a>
          <a class="mdl-navigation__link" href="group.php"><i class="ndl-group"></i>  Group <small class="menuSubLabel">maintenance</small></a>
          <a class="mdl-navigation__link" href="groupservice.php"><i class="ndl-group"></i>  Group <small class="menuSubLabel">service</small></a>
          <a class="mdl-navigation__link" href="addedit.php"><i class="ndl-createnew"></i></i>  Add</a>
          <a class="mdl-navigation__link" href="crm_iframe.php"><i class="ndl-work"></i>  CRM</a>
          <a class="mdl-navigation__link" href="settings.php"><i class="ndl-settings"></i>  Settings</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link menu_logout" href="?logout">
            <button id="menuLogout" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
              <i class="material-icons">exit_to_app</i>
            </button>
            <div class="mdl-tooltip  mdl-tooltip--top" data-mdl-for="menuLogout">
              Logout
            </div>
          </a>
        </nav>
      </div>
        <main class="mdl-layout__content">

            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--3-col mdl-cell--0-col-phone"></div>
              <div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-phone">

                  <div class="demo-card-wide index_card_wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                      <h2 class="mdl-card__title-text">Maintenance Management System</h2>

                      <div class="mdl-layout-spacer"></div>
                      <a style="color: #fff !important;" href="incoming">
                      <div class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php if ($labelID != '0') { if ($results3['messagesTotal'] == 0) { echo "♥"; } else { echo $results3['messagesTotal']; }} else {  echo "♥"; } ?>">email</div></a>
                    </div>
                    <div class="mdl-card__supporting-text">
                      <h6>Welcome <?php echo $token_data['name'] ?>!</h6>
                      <font class="welcomeTime"></font>
                      <script>
                        $(document).ready(function() {
                          var now = moment();
                          var homeNow = moment(now).format("DD MMM YYYY");

                          $('.welcomeTime').html('It is ' + homeNow);
                        });
                      </script>

                      and you have <b><?php echo $results3['messagesTotal'] ?></b> maintenance mails open.</h6>
                      <br><br>And <b><?php echo $results4['messagesTotal'] ?></b> maintenances completed!
                      <br><br>Good luck <img style="height:16px;width:16px;" src="assets/images/google_smiley.png"/>
                      <br><br>
                      <?php
                        /* var_export($token_data);  */
                      ?>
                      <!-- DEBUG 😊
                      <b>Debug:</b>
                      <pre>
                      <?php
                      print_r($results3);

                      echo '<br><br>';

                      var_export($token_data);
                      ?></pre> -->

                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                      <a href="incoming.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color-text--light-green-nt">
                        Incoming
                      </a>
                      <div style="display: inline !important;" class="mdl-layout-spacer"></div>
                      <a href="overview.php" style="float: right;" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--light-green-nt">
                        Overview
                      </a>
                    </div>
                  </div>
              </div>
              <div class="mdl-cell mdl-cell--3-col mdl-cell--0-col-phone"></div>
            </div>
        </main>
        <footer class="mdl-mini-footer mdl-grid">
            <div class="mdl-mini-footer__left-section mdl-cell mdl-cell--10-col mdl-cell--middle">
              <span class="mdl-logo">Newtelco GmbH</span>
              <ul class="mdl-mini-footer__link-list">
                <li><a href="#">Help</a></li>
                <li><a href="#">Privacy & Terms</a></li>
              </ul>
            </div>
          <div class="mdl-layout-spacer"></div>
            <div class="mdl-mini-footer__right-section mdl-cell mdl-cell--2-col mdl-cell--middle mdl-typography--text-right">
              <div class="footertext">
                built with <span class="love">&hearts;</span> by <a target="_blank" class="footera" href="https://github.com/ndom91">ndom91</a> &copy;
              </div>
            </div>
        </footer>
      </div>
</body>
</html>
