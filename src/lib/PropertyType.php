<?php

/**
 * @file
 * PropertyType handling functions.
 */

namespace MDDAPropertyType;

use \MDDADatabase\Database as Database;

/**
 * PropertyType
 * PropertyType instance handler.
 */
class PropertyType {
  /**
   * Saves property type on database.
   * @return bool whether or not the type was saved.
   */
  static function saveType($type) {
    $type = json_decode($type['type_info']);
    $con = Database::getConnection();

    if (!$con) {
      return FALSE;
    }

    // Create new type.
    $stmt = $con->prepare("INSERT INTO property_type (name) VALUES (?)");

    if (!$stmt) {
      return FALSE;
    }

    $stmt->bind_param("s", $type->name);
    $stmt->execute();
  }

  /**
   * Get a list of property types
   * @return string an option list of property types.
   */
  static function getTypes() {
    $con = Database::getConnection();
    $query = "SELECT * FROM property_type";
    $result = $con->query($query);
    $options = '';

    while ($row = $result->fetch_assoc()) {
      $options .= '<option value="' . $row['type_id']
        . '">' . $row['name'] . '</option>';
    }

    return $options;
  }
}
