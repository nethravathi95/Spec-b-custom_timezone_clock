<?php

namespace Drupal\timezone_clock;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Time\Timezone;
use Symfony\Component\Time\TimezoneInterface;

class TimezoneClockService {

  protected $configFactory;
  protected $dateFormatter;
  protected $logger;
  // protected $timezoneService;

  public function __construct(ConfigFactoryInterface $configFactory, DateFormatterInterface $dateFormatter, LoggerChannelFactoryInterface $logger) {
    $this->configFactory = $configFactory;
    $this->dateFormatter = $dateFormatter;
    $this->logger = $logger->get('timezone_clock');
    // $this->timezoneService = $timezoneService;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('date.formatter'),
      $container->get('logger.factory'),
      Timezone::getDefaultTimezone()
    );
  }

  // public function getCurrentTime() {
  //   $config = $this->configFactory->get('timezone_clock.admin_settings');
  //   $timezone = $config->get('timezone');
  //   $current_time = new \DateTime('now', $this->timezoneService->getTimezone($timezone));
  //   $formatted_time = $this->dateFormatter->format($current_time->getTimestamp(), 'custom', 'jS M Y - h:i A', $timezone);

  //   return $formatted_time;
  // }
  public function getCurrentTime() {
    // Get the configured timezone from your configuration or any other source.
    $config = $this->configFactory->get('timezone_clock.admin_settings');
    $timezone = $config->get('timezone');
  
    // Handle the case where the timezone is empty or not set.
    if (empty($timezone)) {
      // You can use a default timezone or provide an error message.
      // For example, using UTC as the default timezone:
      $timezone = 'UTC';
    }
  
    try {
      // Create a DateTime object with the configured timezone.
      $current_time = new \DateTime('now', new \DateTimeZone($timezone));
  
      // Format the current time.
      $formatted_time = $this->dateFormatter->format($current_time->getTimestamp(), 'custom', 'l, j F Y ', $timezone);
      $formatted_date= $this->dateFormatter->format($current_time->getTimestamp(), 'custom', 'g:i A', $timezone);
      // return $formatted_time;
      $time_data = [
        'date' => $formatted_time,
        'time' => $formatted_date,
      ];
      return $time_data;
    } catch (\Exception $e) {
      // Handle any exceptions that may occur when creating the DateTime object.
      // You can log the error, use a default timezone, or provide an error message.
      // For example, logging the error:
      $this->logger->error('Error creating DateTime object: @message', ['@message' => $e->getMessage()]);
      
      // Use a default timezone or return an error message.
      $timezone = 'UTC';
      return 'Error: Unable to determine the current time.';
    }
  }
  
  
}
