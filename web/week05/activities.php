<?php
session_start();

   require('dbConnect.php');
   $d3 = get_db();
   $d4 = get_db();
   $db = get_db();
   $d2 = get_db();

   $sid = $_SESSION['perfUser'];


   // users table
   $stmt = $db->prepare('SELECT password, display_name, username, id FROM users');
   $stmt->execute();
   $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // sports table
   $stmt2 = $d2->prepare('SELECT name, user_id, id FROM sports');
   $stmt2->execute();
   $sports = $stmt2->fetchAll(PDO::FETCH_ASSOC);
   $user = $_SESSION['perfUser'];

   $stmt3 = $d3->prepare('SELECT id, name, day, place, hour_duration, inviroment_quality, sport_id FROM activities' );
   $stmt3->execute();
   $activities = $stmt3->fetchAll(PDO::FETCH_ASSOC);

   // performance table
   $stmt4 = $d4->prepare('SELECT id, name, performance_level, fun_level, health, activitie_id FROM performance');
   $stmt4->execute();
   $performance = $stmt4->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
   <title>Activities</title>
</head>
<body>
<?php
   // $id = $user['id'];
  //
   foreach ($sports as $sport) {
      $sname = $sport['name'];
      $sportid = $sport['id'];
      if ($sid == $sportid) {
        echo "<h1>$sname's Activities</h1>";
      }
   }



  // echo "<li><p> Playing: $s.  $sid</p></li>";
   // loop for activities
   foreach ($activities  as $activity) {
      $aname = $activity['name'];
      $aday = $activity['day'];
      $aid  = $activity['id'];
      $sportid = $activity['sport_id'];
      $place = $activity['place'];
      // if the activiy is realated to the right sport for the user
      if ($sid == $sportid) {
         echo "<ul><li><p> Sport activity: $aname, Date: $aday, Place: $place,</p></li></ul>";

         foreach ($performance as $per) {
            $pname = $per['name'];
            $plevel = $per['performance_level'];
            $pflevel = $per['fun_level'];
            $pid  = $per['id'];
            $perid = $per['activitie_id'];

            if ($aid == $perid) {
              echo "<ul><ul><li><p> Performance LVL($plevel)</p></li></ul></ul>";
               echo "<ul><ul><li><p>Fun Level($pflevel)</p></li></ul></ul>";
            }

         }

      }


   }







?>

</body>
</html>