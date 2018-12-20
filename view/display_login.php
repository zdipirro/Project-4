
<!DOCTYPE html>
<html>

   <head>
      <title>Login Form</title>
      <link rel="stylesheet" href="view/login.css">
   </head>
	
   <body>
   <div class = "logbutton">
     <form method="post" action="index.php">
     <input type="hidden" name="action" value="login"/>
     <center>
       <h1>Login Form</h1>
           <hr>
           <p>Email Address: </p>
           <input type = "text" name = "email" placeholder = "Enter Email Address"/>
           <br>
           <p>Password: </p>
           <input type = "password" name = "password" placeholder = "Enter Password"/>
           <br>
           <hr>
           <input type="submit" name="submit" value="Login" class="logbutton" />
           <br><br><a href="?action=display_registration">Click here to register</a><br><br>
     </form>
   </center>
   </div>
   </body>
 
	
</html>