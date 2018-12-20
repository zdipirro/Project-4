<?php
  foreach ($quesdata as $data) {
    $email = $data ['owneremail'];
    $title = $data['title'] ;
    $body = $data['body'] ;
    $skills = $data['skills'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Question Form</title>
  <link rel = "stylesheet" href = "view/view_ques.css">
</head>
<body>
<form action = "index.php" method = "post">
  <input type="hidden" name="id" value="<?php echo $id ?>"><br>
</form>
  <h5>Posted by <?php echo $email ?>  <a href="index.php?action=display_questions">Go Back to Questions</a></h5>
  <div class = "body">
    <h2><?php echo $title ?></h2>
    <h5>Skills: <?php echo $skills ?></h5>
    <h4><?php echo $body; ?></h4>
  <hr/>
  <form action = "" method = "post">
  <center>
    <textarea name = "reply" rows = "6" cols = "50" placeholder = "Reply Here" required></textarea>
    <input type = "submit" value="Submit Answer"><br><br><br>
  </center>
  </form>
  <hr/>
  </div>
</body>
</html>