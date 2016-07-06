<?php

/**
 * @file
 * Initiates the application.
 */

use \MDDARequestHandler\RequestHandler as RequestHandler;

require 'src/core/RequestHandler.php';

RequestHandler::init();
