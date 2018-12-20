<!DOCTYPE html>
<html>

   <head>
      <title>Question Form</title>
      <link rel = "stylesheet" href = "view/ques.css">
   </head>
	
   <body>
   <form method = "post" action = "index.php">
   <input type="hidden" name="action" value="create_new_question"/>
   <div class = "quesbox" align = "center">
     <h1>Question Form</h1>
     <hr>
     <p>Question Title</p>
     <input type = "text" name = "qname" placeholder = "Enter Question Name" required>
     <p>Question Body</p>
     <textarea name = "qbody" rows = "4" cols = "40" placeholder = "Enter Question Body" required></textarea>
     <p>Question Skills</p>
     <textarea name = "qskills" rows = "4" cols = "40" placeholder = "Enter Question Skills; Separate each skill by comma" required></textarea>
     <hr>
     
     <input type = "submit" name = "button" class = "submit" value = "Submit Question">
      
   </div>
   
   </form>
   </body>
  
</html>

