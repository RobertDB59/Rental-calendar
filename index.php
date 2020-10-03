<?php
  $minScoots =  1;
  $maxScoots = 10;

  $dowMap = array( "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su");

  function rentals($minScoots, $maxScoots){
    for($intAvail = $minScoots; $intAvail <= $maxScoots; $intAvail++){
      if($intAvail > $maxScoots){
        break;
      }
      $slots[] = $intAvail;
    }
    return $slots;
  }
?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0>">

    <title></title>

    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--    <link rel-"stylesheet" href="assets/css/main.css">-->
    <style>
    body H1 { text-align: center;}
    body H2 { font-size: 24px;}
      td { width: 37px; text-align: center;}
      td:first-child { width: 104px; text-align: left;}
    </style>
  </head>


  <body>
    <h1>Rentals</h1>

    <?php
      $dt = new DateTime;
      $dm = new DateTime;
      if (isset($_GET['year']) && isset($_GET['week'])) {
        $dt->setISODate($_GET['year'], $_GET['week']);
      } else {
        $dt->setISODate($dt->format('o'), $dt->format('W'));
      }
      $week = $dt->format('W');
      $month = $dt->format('F');
      $monthNm = $dm->format('F');
      $monthNr = $dt->format('m');
      $year = $dt->format('o');
      $day_of_week = $dt->format('l');
    ?>


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <center>
            <h2><?php echo"$year"; ?></h2>
            <a class="btn btn-link btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?month='.($month-1).'&year='.$year; ?>">Prev month</a> <!-- Previous month -->
            <a class="btn btn-link btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">Prev week</a> <!-- Previous week -->
            <a class="btn btn-link btn-xs" href="index.php">This week</a> <!-- Current week -->
            <a class="btn btn-link btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Next week</a> <!-- Next week -->
            <a class="btn btn-link btn-xs" href="<?php echo $_SERVER['PHP_SELF'].'?month='.($month+1).'&year='.$year; ?>">Next month</a> <!-- Next month -->
          </center>
          <br>
          <table class="table table-bordered">

          <!-- month abr. -->
            <tr class="active">
              <td> </td>
              <?php
                do {
                  if($dt->format('d M Y') == date('d M Y')){
                    echo "<td style='font-size:10px;'>" . $dt->format('M') . "</td>\n";
                  } else {
                    echo "<td style='font-size:10px;'>" . $dt->format('M') . "</td>\n";
                  }
                  $dt->modify('+1 day');
                } while ($week == $dt->format('W'));
                for($d = 7; $d < 28; $d++) {
                  $dt->format('j');
                  echo "<td style='font-size:10px;'>" . $dt->format('M') . "</td>\n";
                  $dt->modify('+1 day');
                }
              ?>
            </tr>

          <!-- date -->
            <tr class="success">
              <td></td>
              <?php
                $dt->modify('-28 day');
                do {
                  if($dt->format('d M Y') == date('d M Y')){
                    $day_of_week = date('N', strtotime($dt->format('l')));
                    echo "<td style='background: #dbdbdb; font-weight: bold;'>" . $dowMap[($dt->format('N'))-1] . "<br>" . sprintf("%02d", $dt->format('j')) . "</td>\n";
                  } else {
                    echo "<td>" . $dowMap[($dt->format('N'))-1] . "<br>" . sprintf("%02d", $dt->format('j')) . "</td>\n";
                  }
                  $dt->modify('+1 day');
                } while ($week == $dt->format('W'));
                for($d = 7; $d < 28; $d++) {
                  $dt->format('j');
                  echo "<td>" . $dowMap[($dt->format('N'))-1] . "<br>" . sprintf("%02d", $dt->format('j')) . "</td>\n";
                  $dt->modify('+1 day');
                }
              ?>
            </tr>

          <!-- rentals -->
            <tr class="active">
              <td>Vehicule Id</td>
              <?php
                $dt->modify('-28 day');
                do {
                  if($dt->format('d M Y') == date('d M Y')){
                    $day_of_week = date('N', strtotime($dt->format('l')));
                    echo "<td style='background: #dbdbdb; font-weight: bold;'>" . "0" . "</td>\n";
                  } else {
                  echo "<td>" . "0" . "</td>\n";
                  }
                  $dt->modify('+1 day');
                } while ($week == $dt->format('W'));
                for($d = 7; $d < 28; $d++) {
                  $dt->format('j');
                  echo "<td>" . "0" . "</td>\n";
                  $dt->modify('+1 day');
                }
              ?>
            </tr>

            <?php
              $rentals = rentals($minScoots, $maxScoots);
              foreach($rentals as $rt){
            ?>
            <tr>

              <td>rental&nbsp;
                <?php 
                  if($rt <10){ echo "00" . $rt;} 
                  if($rt >=10 && $rt <100){ echo "0" . $rt;} 
                  if($rt >=100){ echo $rt;} 
                ?>
              </td>

            <?php
            /* weekdays 1st week */
              if ($day_of_week == 1){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #eff;'>F</td>\n";
              }
              if ($day_of_week == 2){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #eff;'>F</td>\n";
              }
              if ($day_of_week == 3){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #eff;'>F</td>\n";
              }
              if ($day_of_week == 4){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #eff;'>F</td>\n";
              }
              if ($day_of_week == 5){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #eff;'>F</td>\n";
              }
            /* weekend 1st week */
              if ($day_of_week == 6){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #fee;'>F</td>\n";
              }
              if ($day_of_week == 7){
                echo"<td style='background: #dbdbdb; font-weight: bold;'>F</td>\n";
              } else {
                echo"<td style='background: #fee;'>F</td>\n";
              }
              ?>
            <!-- weekdays 2nd week -->
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
            <!-- weekend 2nd week -->
              <td style="background: #fee;">F</td>
              <td style="background: #fee;">F</td>
            <!-- weekdays 3rd week -->
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
            <!-- weekend 3rd week -->
              <td style="background: #fee;">F</td>
              <td style="background: #fee;">F</td>
            <!-- weekdays 4th week -->
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
              <td style="background: #eff; color: #000;">F</td>
            <!-- weekend 4th week -->
              <td style="background: #fee;">F</td>
              <td style="background: #fee;">F</td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>
