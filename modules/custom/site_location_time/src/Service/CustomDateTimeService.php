<?php
// my_module/src/Service/CustomDateTimeService.php

namespace Drupal\site_location_time\Service;

class CustomDateTimeService {

  public function getCurrentDate() {
    // Get the current date.
    return date('Y-m-d');
  }

  public function getCurrentTime() {
    // Get the current time.
    return date('H:i:s');
  }

  public function getCustomDateTime($format = 'Y-m-d H:i:s') {
    // Generate a custom date and time.
    return date($format);
  }
}
