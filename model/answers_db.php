<?php
class Answers {

  public static function getAnswerID($author){
    global $db;
    $query = "SELECT id FROM answers where owneremail = '$author'";
    $q = $db->prepare($query);
    $q->execute();
    $results = $q->fetch(PDO::FETCH_OBJ);
    $q->closeCursor();
    return $results;
  }
  
  public static function getAuthor($answerID) {
    global $db;
    $query = "SELECT owneremail FROM answers WHERE id = '$answerID' ";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $results = $q->fetch(PDO::FETCH_OBJ);
    $stmt->closeCursor();
    return $results;
  }
  
  public static function getScore($answerID){
    global $db;
    $query = "SELECT score FROM answers where id = '$answerID'";
    $q = $db->prepare($query);
    $q->execute();
    $results = $q->fetch(PDO::FETCH_OBJ);
    $q->closeCursor();
    return $results;
  }
  
  public static function downVote($answerID, $score) {
    global $db;
    $q = "UPDATE answers SET score = :score WHERE id = :answerID";
    $stmt = $db->prepare($q);
    $stmt->bindValue(":score", $score);
    $stmt->bindValue(":answerID", $answerID);
    $stmt->execute();
    $stmt->closeCursor();
  }
  
  public static function upVote($answerID, $score) {
    global $db;
    $query = "UPDATE answers SET score = :score WHERE id = :answerID";
    $stmt = $db->prepare($q);
    $stmt->bindValue(":score", $score);
    $stmt->bindValue(":answerID", $answerID);
    $stmt->execute();
    $stmt->closeCursor();
  }
  
}
?>