<?php
class Questions {
  public static function checkSession($email) {
    global $db;
    $query = "SELECT id, email, fname, lname FROM accounts WHERE email = :email";
    $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $session_email = $_SESSION['email'];
    $execute = $stmt->execute(array(':email' => $session_email));
    return $execute;
  }
  
  public static function getInfo($email) {
    global $db;
    $query = "SELECT email, fname, lname, id FROM accounts WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $name = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $name;
  }
  
  public static function getQCount($email) {
    global $db;
    $queryq = "SELECT owneremail, title, body, skills FROM questions WHERE owneremail =:email";
    $stmtq = $db->prepare($queryq);
    $stmtq->bindValue(':email', $email);
    $stmtq->execute();
    $ques = $stmtq->fetchAll();
    $count = $stmtq->rowCount();
    $stmtq->closeCursor();
    return $count;
  }
  
  public static function newQuestion($qname, $qbody ,$skills, $email, $id) {
    $query = "INSERT INTO questions (title, body, skills, owneremail, ownerid) VALUES ('$qname', '$qbody', '$skills', '$email', '$id')";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
  }
  
  public static function getQuestions($email) {
    global $db;
    $queryq = "SELECT * FROM questions WHERE owneremail =:email";
    $stmtq = $db->prepare($queryq);
    $stmtq->bindValue(':email', $email);
    $stmtq->execute();
    $ques = $stmtq->fetchAll();
    $stmtq->closeCursor();
    return $ques;
  }
  
  public static function getAllQuestions() {
    global $db;
    $queryq = "SELECT * FROM questions";
    $stmtq = $db->prepare($queryq);
    $stmtq->execute();
    $ques = $stmtq->fetchAll();
    $stmtq->closeCursor();
    return $ques;
  }
  
  public static function deleteQuestion($id) {
    global $db;
    $query = "DELETE FROM questions WHERE id = '$id'";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
  }
  
  public static function getQuestionData($id){
    global $db;
    $query = "SELECT * FROM questions where id = '$id'";
    $q = $db->prepare($query);
    $q->execute();
    $results = $q->fetchAll();
    $q->closeCursor();
    return $results;
  }
  
  public static function getQuestionID($id){
    global $db;
    $query = "SELECT id FROM questions where id = '$id'";
    $q = $db->prepare($query);
    $q->execute();
    $results = $q->fetch(PDO::FETCH_OBJ);
    $q->closeCursor();
    return $results;
  }
  
  public static function updateQuestion($id, $qname, $qbody, $skills){
    global $db;
        $query = "UPDATE questions SET title = :qname, body= :qbody, skills = :qskills    where id = '$id'";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':qname', $qname);
        $stmt->bindValue(':qbody', $qbody);
        $stmt->bindValue(':qskills', $skills);
        $stmt->execute();
        $stmt->closeCursor();
  }
  
  public static function getAnswers($id) {
    global $db;
    $querya = "SELECT * FROM answers WHERE ownerid = '$id' ";
    $stmta = $db->prepare($querya);
    $stmta->execute();
    $answers = $stmta->fetchAll();
    $stmta->closeCursor();
    return $answers;
  }
  
}
?>