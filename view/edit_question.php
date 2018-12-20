<?php
  foreach ($quesdata as $data) {
    $email = $data ['owneremail'];
    $title = $data['title'] ;
    $body = $data['body'] ;
    $skills = $data['skills'];
  }
?>
<head>
  <title>Question Form</title>
  <link rel = "stylesheet" href = "view/ques.css">
</head>
<form action ="index.php" method= "post">
<div class = "quesbox" align = "center">
<h1>Question Form</h1>
  <input type="hidden" name="action" value="updateQuestion"><br>
   <input type="hidden" name="id" value="<?php echo $id ?>"><br>
   <input type="hidden" name="email" value="<?php echo $email ?>"><br>
    Question Name: <input type = text name = "qname"  id = "user" value="<?php echo $title ?>" placeholder="Enter Questions Name "  autofocus ><br>
    Question Body: <input type = text name = "qbody"  id = "user" value="<?php echo $body; ?>" placeholder="Enter Question Body" > <br><br>
    Question Skill: <input type = text name = "qskills"  id = "user" value="<?php echo $skills ?>" placeholder="Enter Question Skills" ><br><br>
    <input type=submit value="Update Question" ><br>
</div>
</form>