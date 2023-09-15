<?php
namespace Drupal\site_location_time\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\site_location_time\Service\TimezoneService;
// use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Provides a 'Site Location and Time' block.
 *
 * @Block(
 *   id = "site_location_time_block",
 *   admin_label = @Translation("Site Location and Time"),
 * )
 */
class SiteLocationTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $timezoneService;

  

  public function __construct(array $configuration, $plugin_id, $plugin_definition, TimezoneService $timezoneService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezoneService = $timezoneService;
    // $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('site_location_time.service'), // Replace 'site_location_time' with your actual module name.
      // $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  // public function build() {
  //   // Get configuration values.
  //   // $config = $this->configFactory->get('site_location_time.settings'); // Replace 'site_location_time' with your actual module name.
  //   // $country = $config->get('country');
  //   // $city = $config->get('city');
  //   // $timezone = $config->get('timezone');

  //   // // Use the TimezoneService to get the current time.
  //   // $current_time = $this->timezoneService->getCurrentTime($timezone);

  //   // // Build the block content.
  //   // $build = [
  //   //   '#theme' => 'site_location_time_block_template', // Replace with your actual template name.
  //   //   '#content' => [
  //   //     'location' => $this->t('Location: @country, @city', ['@country' => $country, '@city' => $city]),
  //   //     'current_time' => $this->t('Current Time: @time', ['@time' => $current_time]),
  //   //   ],
      
  //   // ];

  //   // return $build;
  //   $output = [
  //     '#markup' => $this->t('Setting One: @setting_one, Setting Two: @setting_two', [
  //       '@setting_one' => 'one',
  //       '@setting_two' => 'two',
  //     ]),
  //   ];

  //   return $output;
  // }
/**
 * {@inheritdoc}
 */
public function build() {
  $config = $this->configuration;
  $current_time = $this->timezoneService->getCurrentTime();

  return [
    '#markup' => $this->t('Location: @country, @city<br>Current Time: @time', [
      '@country' => $config['country'],
      '@city' => $config['city'],
      '@time' => $current_time,
    ]),
  ];
}

}


