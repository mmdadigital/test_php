<?php

/**
 * @file
 * Property handling functions.
 */

namespace MDDAProperty;

use \MDDADatabase\Database as Database;

/**
 * Property
 * Property instance handler.
 */
class Property {
  /**
   * Saves a property in database.
   * @return bool whether or not the property was saved.
   */
  static function saveProperty($property) {
    $con = Database::getConnection();

    if (!$con) {
      return FALSE;
    }

    // Create new property.
    $stmt = $con->prepare("INSERT INTO property (property_type, street, number, city, state, description, responsible) VALUES (?, ? , ? , ? , ? , ? , ?)");

    if (!$stmt) {
      return FALSE;
    }

    $stmt->bind_param(
      "sssssss",
      $property['property_type'],
      $property['street'],
      $property['number'],
      $property['city'],
      $property['state'],
      $property['description'],
      $property['responsible']
    );
    $stmt->execute();

    // Get property id.
    $stmt = $con->prepare("SELECT property_id FROM property ORDER BY property_id DESC LIMIT 1");
    $stmt->execute();
    $stmt->bind_result($id);
    $stmt->fetch();
    $stmt->close();

    // Insert property photos.
    $photos = explode(';', $property['photos']);
    foreach ($photos as $url) {
      $query = "INSERT INTO photos (property_id, url) VALUES (?, ?)";
      $stmt = $con->prepare($query);
      $stmt->bind_param("ss", $id, $url);
      $stmt->execute();
    }

    return TRUE;
  }

  /**
   * Returns a list of properties.
   * @return  string an ul li list of properties.
   */
  static function getProperties() {
    $con = Database::getConnection();

    if (!$con) {
      return '';
    }

    $options = '<ul>';
    $query = "SELECT * FROM property";
    $result = $con->query($query);

    while ($row = $result->fetch_assoc()) {
      $options .= "<li><a href=\"imovel/{$row['property_id']}\">{$row['street']} {$row['number']} {$row['city']}</a></li>";
    }

    $options .= '</ul>';
    return $options;
  }

  /**
   * Build a property html.
   * @return string the property html representation.
   */
  static function loadProperty($id) {
    $con = Database::getConnection();

    if (!$con) {
      return '';
    }

    $query = "SELECT property_type, street, number, city, state, description, responsible FROM property where property_id = $id";
    $result = $con->query($query);
    $property = $result->fetch_assoc();

    $content = '<div>';
    // Get responsible name.
    $query = "SELECT name FROM user where user_id = {$property['responsible']}";
    $result = $con->query($query);
    $responsible = $result->fetch_assoc();
    // Show property info.
    $content .= "<p>
      Rua: {$property['street']} <br/>
      Número: {$property['number']} <br/>
      Cidade: {$property['city']} <br/>
      Estado: {$property['state']} <br/>
      Descrição: {$property['description']} <br/>
      Contato: {$responsible['name']} <br/>
      Photos: <br/>
    </p>";

    // Show photos.
    $query = "SELECT url FROM photos WHERE property_id = $id";
    $result = $con->query($query);

    while ($row = $result->fetch_assoc()) {
      $content .= "<img src='{$row['url']}' />";
    }

    // Load related properties.
    $query = "SELECT property_id, responsible FROM property WHERE state = '{$property['state']}' LIMIT 3";
    $result = $con->query($query);

    $content .= '<div style="margin-top:50px">';

    while ($row = $result->fetch_assoc()) {
      // Get responsible.
      $query = "SELECT name FROM user WHERE user_id = {$row['responsible']}";
      $responsible_result = $con->query($query);
      $user = $responsible_result->fetch_assoc();

      // Get phone.
      $query = "SELECT phone FROM phones WHERE user_id = {$row['responsible']} ORDER BY phone_id ASC LIMIT 1";
      $phone_result = $con->query($query);
      $phone = $phone_result->fetch_assoc();

      // Get photo.
      $query = "SELECT url FROM photos WHERE property_id = $id ORDER BY photo_id ASC LIMIT 1";
      $photo_result = $con->query($query);
      $photo = $photo_result->fetch_assoc();

      $content .= "<div style='margin:10px; border:1px solid #7d90ea;'>
        Contato: {$user['name']} <br/>
        Telefone: {$phone['phone']} <br/>
        <img src='{$photo['url']}' />
        </div>";
    }


    $content .= '</div><div>';

    return $content;
  }
}
