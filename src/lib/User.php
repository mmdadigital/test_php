<?php

/**
 * @file
 * User account handler class.
 */

namespace MDDAUser;

use \MDDADatabase\Database as Database;

/**
 * User
 * User account handler.
 */
class User {
  /**
   * Saves user in database.
   * @return bool whether or not the user was saved.
   */
  static function saveUser($user) {
    $user = json_decode($user['user_info']);
    $con = Database::getConnection();

    if (!$con) {
      return FALSE;
    }

    // Create new user.
    $stmt = $con->prepare("INSERT INTO user (name) VALUES (?)");

    if (!$stmt) {
      return FALSE;
    }

    $stmt->bind_param("s", $user->name);
    $stmt->execute();

    // Get user id.
    $stmt = $con->prepare("SELECT user_id FROM user WHERE name = ? ORDER BY user_id DESC LIMIT 1");
    $stmt->bind_param("s", $user->name);
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    // Insert user phones.
    $phones = explode(';', $user->phones);
    foreach ($phones as $phone) {
      $query = "INSERT INTO phones (user_id, phone) VALUES (?, ?)";
      $stmt = $con->prepare($query);
      $stmt->bind_param("ss", $id, $phone);
      $stmt->execute();
    }

    // Insert user e-mails.
    $emails = explode(';', $user->emails);
    foreach ($emails as $email) {
      $query = "INSERT INTO emails (user_id, email) VALUES (?, ?)";
      $stmt = $con->prepare($query);
      $stmt->bind_param("ss", $id, $email);
      $stmt->execute();
    }
    return TRUE;
  }

  /**
   * Gets a list of users.
   * @return  string an option list of users.
   */
  static function getUsers() {
    $con = Database::getConnection();
    $query = "SELECT * FROM user";
    $result = $con->query($query);
    $options = '';

    while ($row = $result->fetch_assoc()) {
      $options .= '<option value="' . $row['user_id']
        . '">' . $row['name'] . '</option>';
    }

    return $options;
  }

}
