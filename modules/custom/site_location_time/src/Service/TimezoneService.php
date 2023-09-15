<?php

namespace Drupal\site_location_time;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Time\Timezone;
use Symfony\Component\Time\TimezoneInterface;

class TimezoneService {

  // use StringTranslationTrait;

  protected $configFactory;
  protected $dateFormatter;
  protected $logger;
  protected $timezoneService;

  public function __construct(ConfigFactoryInterface $configFactory, DateFormatterInterface $dateFormatter) {
    $this->configFactory = $configFactory;
    $this->dateFormatter = $dateFormatter;
    $this->logger = $logger->get('site_location_time');
    $this->timezoneService = $timezoneService;
  }
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('date.formatter'),
      $container->get('logger.factory'),
      Timezone::getDefaultTimezone()
    );
  }

  public function getCurrentTime() {
    $config = $this->configFactory->get('site_location_time.settings');
    $timezone = $config->get('timezone');
    $current_time = new \DateTime('now', $this->timezoneService->getTimezone($timezone));
    $formatted_time = $this->dateFormatter->format($current_time->getTimestamp(), 'custom', 'jS M Y - h:i A', $timezone);

    return $formatted_time;
  }

  // /**
  //  * Get the current time based on the selected timezone.
  //  *
  //  * @return string
  //  *   The formatted current time.
  //  */
  // public function getCurrentTime() {
  //   // Get the selected timezone from configuration.
  //   $config = $this->configFactory->get('site_location_time.settings');
  //   $timezone = $config->get('timezone');

  //   // Create a DateTime object with the specified timezone.
  //   $datetime = new \DateTime('now', new \DateTimeZone($timezone));

  //   // Format the datetime as per your requirement.
  //   $formattedTime = $this->dateFormatter->format($datetime->getTimestamp(), 'custom', 'dS M Y - h:ia', $timezone);

  //   return $formattedTime;
  // }

}
