<link href="../assets/css/style.css" rel="stylesheet" type="text/css" />


<?php


  $page = "";

  if (isset($_GET['page']))
  {
    if ($_GET['page'] != "")
    {
      $page = $_GET['page'];
    }
  }


  include_once('../database/db_con.php');
  //session_start();

  if ($page == "comment") {
    $sql = 	"SELECT topic.tid, topic.color, topic.description, topic.like, topic.dislike, COUNT(COMMENT.tid) AS comments FROM `topic` LEFT JOIN `comment` ON topic.tid = COMMENT.tid GROUP BY topic.tid ORDER BY comments DESC";

    //SELECT `tid`, `color`, `description`, `like`, `dislike` FROM `topic` ORDER BY tid";
  } elseif ($page == "popular") {
    $sql = 	"SELECT `tid`, `color`, `description`, `like`, `dislike`, (`like`-`dislike`) FROM `topic` ORDER BY 6 DESC";
  } else {
    $sql = 	"SELECT `tid`, `color`, `description`, `like`, `dislike` FROM `topic` ORDER BY tid DESC";
  }

  //$sql = 	"SELECT `tid`, `color`, `description`, `like`, `dislike` FROM `topic` ORDER BY tid DESC";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $popularity = $row["like"] - $row["dislike"];
      echo "<div class='topicBox' style='background-color:".$row["color"].";' >";
      echo "  <p><a href='../frontend/commentVisitor.php?tid=".$row['tid']."'>".htmlspecialchars($row["description"])."</a><br>Likes: <span id='liketid".$row['tid']."'>".$row["like"]."</span> Dislikes: <span id='disliketid".$row['tid']."'>".$row["dislike"]."</span> Popularity: <span id='popularityid".$row['tid']."'>$popularity</span></p>";
      echo "  <div style='margin-left: 12px; display: inline-block; ' onclick='like(".$row['tid'].");'><img style='width: 30px;' src='../assets/images/up.png'></div>";
      echo "  <div style='display: inline-block; width:20px;'></div>";
      echo "  <div style='display: inline-block;'  onclick='dislike(".$row['tid'].");'><img style='width: 30px;' src='../assets/images/down.png'></div>";
      echo "</div>";
    }
  } else {
    echo "No Topics";
  }

?>