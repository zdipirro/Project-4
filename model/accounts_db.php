<?php
class Accounts {
  public static function getUser($email) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM accounts WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $fetch = $stmt->fetchAll();
    return $fetch;
  }
  
  public static function CreateUser($bday, $email, $first, $last, $pass) {
    global $db;
    $query = "INSERT INTO accounts (birthday, email, fname, lname, password) VALUES ('$bday', '$email', '$first', '$last', '$pass')";
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
  }
  
  
}
?>