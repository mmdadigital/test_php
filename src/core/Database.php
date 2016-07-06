<?php

/**
 * @file
 * Database layer functions.
 */
namespace MDDADatabase;

/**
 * Database
 * Provide database connection and common methods.
 */
class Database {
  /**
   * Database settings getter.
   * @return array database settings.
   */
  static function getSettings() {
    return array(
      'server' => 'localhost',
      'user' => 'root',
      'pass' => 'root',
      'database' => 'testesphp',
    );
  }

  /**
   * Gets the database connection.
   * @return mixed the database connection or false
   * in case of an error.
   */
  static function getConnection() {
    $settings = Database::getSettings();
    $connection = new \mysqli($settings['server'], $settings['user'], $settings['pass'], $settings['database']);
    return $connection->connect_errno ? FALSE : $connection;
  }
}
