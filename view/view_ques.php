<?php
  foreach ($quesdata as $data) {
    $email = $data ['owneremail'];
    $title = $data['title'] ;
    $body = $data['body'] ;
    $skills = $data['skills'];
    $id = $data['id'];
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
  <input type="hidden" name="id" value="<?php echo $id ?>">
</form>
  <h5>Posted by <?php echo $email ?>  <a href="index.php?action=display_questions">Go Back to Questions</a></h5>
  <div class = "body">
  <form action = "" method = "post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="action" value="upVote">
    <?php foreach($getID as $IDS) {
    $id = $IDS;
    }?>    
    <h2><button type = "submit"><img src='images/upvote.jpg' width='20px' height='15px' style='float:left'></button>
  </form>
  <form action = "" method = "post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="action" value="downVote">
    <button type = "submit"><img src='images/upvote.jpg' width='20px' height='15px' id = "down" style='float:left'></button>
  </form>
    <?php echo $title ?></h2>
    <h5 id = "skills">Skills: <?php echo $skills ?></h5>
    <h4><?php echo $body; ?></h4>
  <hr/>
  <form action = "" method = "post">
  <center>
    <textarea name = "answer" rows = "6" cols = "50" placeholder = "Reply Here" required></textarea>
    <input type="hidden" name="action" value="addAnswer">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type = "submit" value="Submit Answer" onClick='window.location.reload()'><br><br><br>
  </center>
  </form>
  <hr/>
  <?php foreach($getAnswers as $answers) {
    $answer = $answers['answer'];
    $author = $answers['owneremail'];
    $score = $answers['score'];
  ?>
  <p>
  <form action = "" method = "post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="action" value="upVote">
  <button type="submit"><img src='images/upvote.jpg' width='20px' height='15px' style='float:left'></button>
  </form>
  <form action = "" method = "post">
    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="action" value="downVote">
  <button type="submit"><img src='images/upvote.jpg' width='20px' height='15px' id = "down" style='float:left'></button>
  </form>
  <h6>Submitted by <?php echo $author; echo '&nbsp'; echo '&nbsp'; echo $score." Points"?></h6>
  <h4 id = "answer"><?php echo $answer; ?></h4>
  <?php } ?>
  </p>
  </div>
</body>
</html>