<!DOCTYPE html>
<?php
require('authenticate_google.php');
require_once('config.php');

global $dbhandle;

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['id_token_token']);
}

?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="manifest" href="manifest.json"></link>
  <meta name="application-name" content="Newtelco Maintenance">
  <title>Newtelco Maintenance | Welcome</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel='stylesheet' href='assets/css/style.css'>

  <!-- font awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

  <!-- Google font-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

  <!-- material design -->
  <link rel="stylesheet" href="assets/css/material.css">
  <script src="assets/js/material.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <?php
          function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    ?>
</head>
<body>
  <!-- Always shows a header, even in smaller screens. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header ">
      <header class="mdl-layout__header mdl-color--light-green-nt">
        <div class="mdl-layout__header-row">
          <a href="index.php"><img style="margin-right: 10px" src="assets/images/nt_square32_2_light2.png"/></a>
          <span class="mdl-layout-title">Maintenance</span>
          <div class="mdl-layout-spacer"></div>
          <div class="menu_userdetails">
            <span class="mdl-layout-subtitle"><?php echo $token_data['email'] ?></span>
            <img class="menu_userphoto" src="<?php echo $token_data['picture'] ?>"/>
          </div>
        </div>
      </header>
      <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Maintenance</span>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="index.php"><i class="fas fa-home"></i>  Home</a>
          <a class="mdl-navigation__link" href="overview.php"><i class="fas fa-book-open"></i>  Overview</a>
          <a class="mdl-navigation__link" href="incoming.php"><i class="fas fa-folder-plus"></i>  Incoming</a>
          <a class="mdl-navigation__link" target="_blank" href="https://crm.newtelco.de"><i class="fas fa-users"></i>  CRM</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link menu_logout" href="?logout">
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Logout</button>
          </a>
        </nav>
      </div>
        <main class="mdl-layout__content">
            <div class="mdl-grid">
              <div class="mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                <div class="mdl-grid">
                  <div class="mdl-cell mdl-cell--2-col">
                    <form action="overview" method="post">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" name="tKunde" id="tKunde">
                        <label class="mdl-textfield__label" for="tKunde">Kunde</label>
                      </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="tLieferant">
                        <label class="mdl-textfield__label" for="tLieferant">Lieferant</label>
                      </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="tuCID">
                        <label class="mdl-textfield__label" for="tuCID">unsere CID</label>
                      </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="tdCID">
                        <label class="mdl-textfield__label" for="tdCID">deren CID</label>
                      </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col"></div>
                  <div class="mdl-cell mdl-cell--2-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored mdl-color--light-green-nt">
                      <i class="material-icons">search</i>
                    </button>
                    </form>
                  </div>
                </div>
                <?php 
                $kunde = '';

                if (! empty($_POST['tKunde'])){
                      $kunde = $_POST['tKunde'];
                  }
                $query = $kunde;

                $kunden_escape = mysqli_real_escape_string($dbhandle, $query);
                $kunden_query = mysqli_query($dbhandle, "SELECT `id`,`name` FROM `companies` WHERE `name`='$kunden_escape'");

                if ($fetch = mysqli_fetch_array($kunden_query)) {
                    //Already has some IP address records in the database
                    //Get the total failed login attempts associated with this IP address
                    $kunden_id = $fetch[0];
                    $resultx = mysqli_query($dbhandle, "SELECT maintenancedb.maileingang, maintenancedb.receivedmail, companies.name, kunden.derenCID, maintenancedb.bearbeitetvon, maintenancedb.maintenancedate, maintenancedb.startDateTime, maintenancedb.endDateTime, maintenancedb.postponed, maintenancedb.notes, maintenancedb.mailankunde, maintenancedb.mailsend, maintenancedb.cal FROM maintenancedb  LEFT JOIN kunden ON maintenancedb.derenCIDid = kunden.id LEFT JOIN companies ON maintenancedb.lieferant = companies.id WHERE lieferant LIKE '$kunden_id'");
                    //$rowx = mysqli_fetch_array($resultx);
                    //echo("Error description: " . mysqli_error($dbhandle));

                    echo '<table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-shadow--4dp">
                            <thead>
                              <tr>
                                <th class="mdl-data-table__cell--non-numeric">Mail Eingang Date/Time</th>
                                <th>Received Mail Date/Time</th>
                                <th>Company Name</th>
                                <th>Deren CID</th>
                                <th>Bearbeitet Von</th>
                                <th>Maintenance Date/Time</th>
                                <th>Start Date/Time</th>
                                <th>End Date/Time</th>
                                <th>Postponed</th>
                                <th>Notes</th>
                                <th>Mail Ankunde Date/Time</th>
                                <th>Mail to Send</th>
                                <th>Add to Cal</th>
                              </tr>
                            </thead>
                            <tbody>';

                      while ($rowx = mysqli_fetch_assoc($resultx)) {
                        echo '<tr>';
                        foreach($rowx as $field) {
                            echo '<td>' . htmlspecialchars($field) . '</td>';
                        }
                        echo '</tr>';
                    }
                    echo '</tbody>
                    </table>';
                  }

                ?>

              </div>
            </div>
        </main>
        <footer class="mdl-mini-footer">
            <div class="mdl-mini-footer__left-section">
              <span class="mdl-logo">Newtelco GmbH</span>
              <ul class="mdl-mini-footer__link-list">
                <li><a href="#">Help</a></li>
                <li><a href="#">Privacy & Terms</a></li>
              </ul>
            </div>
            <div class="mdl-mini-footer__right-section">
              <div>
                built with <span class="love">&hearts;</span> by <a target="_blank" class="footera" href="https://github.com/ndom91">ndom91</a> &copy;
              </div>
            </div>
        </footer>
      </div>
</body>
</html>

