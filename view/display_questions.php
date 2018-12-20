<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$db = new PDO($dsn, $username, $password);
if ( $getUser > 0) {
    foreach ($getUser as $user) {
        $fname = $user['fname'];
        $lname = $user['lname'] . '<br>';
    }
}
else {
    echo ' Email does not exist';
}

?>
<!DOCTYPE html>
<html>

   <head>
      <title>Profile Page</title>
      <link type="text/css" rel="stylesheet" href="view/display_questions.css" />
   </head>
	
   <body>
   <center>
   <div class = "container">
   <div id = "menu">
   <a href="logout.php">Logout</a>
   </div>
   <article class = "tabs">
   
     <section id="myQ">
       <h2><a href = "index.php?action=display_questions#myQ">My Questions</a></h2>
       <?php 
       if(count($getQuestions) < 1) {
        echo "<h3> You currently have no questions asked.</h3>";
       }
       ?>
       <table>
       <tr class="title">
        <td>Title</td><td>&nbsp;</td><td>&nbsp;</td>

        <?php foreach($getQuestions as $questions) {?>

        <tr>
        <td>
            <form action ="" method= "post" >
              <input type="hidden" name="action" value="viewQues">
              <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
              <button type="submit" value="ques"><?php echo $questions['title'];?></button>
            </form>
        </td>
        <td>
            <form action ="" method= "post" >
                <input type="hidden" name="action" value="editQuestion">
                <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
                <input type="submit" value="EDIT">
            </form>
        </td>
        <td>
            <form action ="" method= "post" >
                <input type="hidden" name="action" value="deleteQuestion">
                <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
                <input type="hidden" name="email" value="<?php echo $questions['owneremail'];?>">
                <input type="submit" value="DELETE">
            </form>
        </td>
        </tr>
        <?php }?>
       </table>
       <div class = "ask">
         <a href="index.php?action=display_new_question">Click here to ask a quesiton</a><br><br>
       </div>
     </section>

     <section id="allQ">
       <h2><a href = "index.php?action=display_questions#allQ">All Questions</a></h2>
              <?php 
       if(count($getQuestions) < 1) {
        echo "<h3> You currently have no questions asked.</h3>";
       }
       ?>
       <table>
       <tr class="title">
        <td>Title</td><td>Body</td><td>Skills</td>

        <?php foreach($getAllQuestions as $questions) {?>

        <tr>
        <td>

            <form action ="" method= "post" >
              <input type="hidden" name="action" value="viewQues">
              <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
              <button type="submit" value="ques"><?php echo $questions['title'];?></button>
            </form>
        </td>
        <td><?php echo $questions['body'];?></td>
        <td><?php echo $questions['skills'];?></td>
        </tr>
        <?php }?>
       </table>
       <div class = "ask">
         <a href="index.php?action=display_new_question">Click here to ask a quesiton</a><br><br>
       </div>
     </section>
   </article>
   </div>
   </center>
   </body>
 
	
</html>
