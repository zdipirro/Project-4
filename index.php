<?php 
include("model/accounts_db.php");
include("model/database.php");
include("model/questions_db.php");
include("model/answers_db.php");

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'display_login';
  }
}

if ($action == 'display_login') {
  include("view/display_login.php");
  if(!isset($_SESSION['email'])) {
    if(isset($_GET["feedback"])) {
      echo $_GET["feedback"];
    }
  }
}

elseif ($action == 'display_registration') {
  include("view/display_registration.php");
}

elseif ($action == 'register') {
  $first = filter_input(INPUT_POST, 'first');
  $last = filter_input(INPUT_POST, 'last');
  $bday = filter_input(INPUT_POST, 'bday');
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'pass');
  $passlength = strlen($pass);
  
  if (empty($first)) {
    echo "You forgot to enter your first name<br><br>";
  }
  
  if (empty($last)) {
    echo "You forgot to enter your last name<br><br>";
  }
    
  if (empty($bday)) {
    echo "You forgot to enter your first name<br><br>";
  }
  
  if (empty($email)) {
    echo "You forgot to enter you email address<br><br>";
  }
  else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "You entered an invalid email address<br><br>";
    }
  }
  
  if (empty($pass)) {
    echo "You forgot to enter your password<br><br>";
  }
  else {
    if ($passlength < 8) {
      echo "Password must be at least 8 characters long<br><br>"; 
    }
  } 
$f = new Accounts();
$f->CreateUser($bday, $email, $first, $last, $pass);
session_start();
$_SESSION['email'] = $email; 
header('Location: index.php?action=display_questions');
}

elseif ($action == 'login') {
  $db = new PDO($dsn, $username, $password);
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'password');
  $passlength = strlen($pass);

  if (empty($email)) {
    header('Location: index.php?feedback=You forgot to enter your e-mail');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?feedback=Invalid Email');
  }
  
  if (empty($pass)) {
    header('Location: index.php?feedback=Missing Password');
  }

  else {
    if ($passlength < 8) {
      header('Location: index.php?feedback=Password must be at least 8 characters long');
    }
  }
  $f = new Accounts();
  $user = $f->GetUser($email);
  if ($user === false) {
    echo "This email has not yet been registered into our system<br><br>";
    echo '<a href="https://web.njit.edu/~ztd2/IS-218-Project-3/view/display_registration.php">Click   here to register</a><br><br>'; 
    echo 'If you wish to go back to the login page, <a href="https://web.njit.edu/~ztd2/IS-218-Project-3/index.php">Click here</a>';
  }
  else {
  session_start();
  $_SESSION['email'] = $email;
  header('Location: index.php?action=display_questions');
  }
  
}

elseif ($action == 'display_questions') {
  session_start();
  $email = $_SESSION['email'];
  $f = new Questions();
  $getQuestions = $f->getQuestions($email);
  $s = new Accounts();
  $getUser = $s->getUser($email);
  $a = new Questions();
  $getAllQuestions = $a->getAllQuestions();
  include("view/display_questions.php");
}

elseif ($action == 'viewQues') {
    $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    $q = new Questions();
    $quesdata = $q->getQuestionData($id);
    $v = new Questions();
    $getID = $v->getQuestionID($id);
    $z = new Questions();
    $getAnswers = $z->getAnswers($id);
    if ($id == NULL || $id == FALSE ) {
        echo "Missing or incorrect id.";
    } else {
        include('view/view_ques.php');
    }
}

elseif ($action == 'display_new_question') {
  include("view/display_new_question.php");
}

else if ($action == 'editQuestion') {
    $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
    $d = new Questions();
    $quesdata = $d->getQuestionData($id);
    if ($id == NULL || $id == FALSE ) {
        echo "Missing or incorrect id.";
    } else {
        include('view/edit_question.php');
    }
}

else if ($action == 'updateQuestion') {
  $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
  $qname = filter_input(INPUT_POST, 'qname');
  $qbody = filter_input(INPUT_POST, 'qbody');
  $qskills = filter_input(INPUT_POST, 'qskills');
  $array = array($qskills);
  $skills = implode(', ', $array);
  $qnlength = strlen($qname);
  $qblength = strlen($qbody);
  $qslength = count($skills);

  if (empty($qname)) {
    echo "You forgot to enter the name of your question<br><br>";
    $errors +=1;
  }
  else {
    if ($qnlength < 3) {
      echo "Question name must be at least 3 characters long<br><br>";
      $errors +=1;
    }
  }

  if (empty($qbody)) {
    echo "You forgot to enter information into the question body<br><br>";
    $errors +=1;
  }
  else {
    if ($qblength > 500) {
      echo "Question body has a maximum length of 500 characters<br><br>"; 
      $errors +=1;
    }
  }
  $u = new Questions();
  $u->updateQuestion($id, $qname, $qbody, $skills);
  header("Location: index.php?action=display_questions");
}
elseif ($action == 'create_new_question') {
  $qname = filter_input(INPUT_POST, 'qname');
  $qbody = filter_input(INPUT_POST, 'qbody');
  $qskills = filter_input(INPUT_POST, 'qskills');
  $array = array($qskills);
  $skills = implode(', ', $array);
  $qnlength = strlen($qname);
  $qblength = strlen($qbody);
  $qslength = count($skills);

  if (empty($qname)) {
    echo "You forgot to enter the name of your question<br><br>";
    $errors +=1;
  }
  else {
    if ($qnlength < 3) {
      echo "Question name must be at least 3 characters long<br><br>";
      $errors +=1;
    }
  }

  if (empty($qbody)) {
    echo "You forgot to enter information into the question body<br><br>";
    $errors +=1;
  }
  else {
    if ($qblength > 500) {
      echo "Question body has a maximum length of 500 characters<br><br>"; 
      $errors +=1;
    }
    else {
      session_start();
      $email = $_SESSION['email'];
      $query = "INSERT INTO questions (title, body, skills, owneremail, ownerid) VALUES ('$qname', '$qbody', '$skills', '$email', '$id')";
      $statement = $db->prepare($query);
      $statement->execute();
      $statement->closeCursor();
      header('Location: index.php?action=display_questions');
   }
  }
}

else if ($action == 'deleteQuestion') {
  $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
  $email = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  if ($id == NULL || $id == FALSE || $email == NULL || $email == FALSE ) {
    echo "Missing or incorrect product id or category id.";
  } 
  else {
    $d = new Questions();
    $d->deleteQuestion($id);
    header("Location: index.php?action=display_questions");
  }
}

else if ($action == 'addAnswer') {
  $answer = filter_input(INPUT_POST, 'answer');
  $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
  session_start();
  $email = $_SESSION['email']; 
  $query = "INSERT INTO answers (answer, owneremail, ownerid) VALUES ('$answer', '$email', '$id')";
  $statement = $db->prepare($query);
  $statement->execute();
  $statement->closeCursor();
}

else if ($action == 'upVote') {
  $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
  $z = new Answers();
  $getAnswerID = $z->getAnswerID($author);
    foreach($getAnswerID as $ids) {
    $answerID = $ids;
  }
  $g = new Answers();
  $getScore = $g->getScore($answerID);
  foreach($getScore as $scores) {
    $score = $scores;
  }
  $score+=1;
  $a = new Answers();
  $upvote = $a->upVote($answerID, $score);
  header("Location: index.php?action=display_questions");
  
}

else if ($action == 'downVote') {
  $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
  $z = new Answers();
  $getAnswerID = $z->getAnswerID($author);
  foreach($getAnswerID as $ids) {
    $answerID = $ids;
  }
  $g = new Answers();
  $getScore = $g->getScore($answerID);
  foreach($getScore as $scores) {
    $score = $scores;
  }
  $score-=1;
    $i = new Answers();
  $getAuthor = $i->getAuthor($answerID);
  foreach($getAuthor as $authors) {
    $author = $authors['owneremail'];
  }

  $a = new Answers();
  $downvote = $a->downVote($answerID, $score);
  header("Location: index.php?action=display_questions");
}
?>