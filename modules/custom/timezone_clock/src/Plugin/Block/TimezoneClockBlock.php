<?php

namespace Drupal\timezone_clock\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\timezone_clock\TimezoneClockService;
use Drupal\Core\Plugin\Annotation\Block;
use Drupal\Core\Config\ConfigFactoryInterface;
/**
 * Provides a 'Timezone Clock' Block.
 *
 * @Block(
 *   id = "timezone_clock_block",
 *   admin_label = @Translation("Timezone Clock Block"),
 * category = @Translation("Custom"),
 * )
 */
class TimezoneClockBlock extends BlockBase implements ContainerFactoryPluginInterface {

  protected $timezoneClockService;
  // protected $configFactory;

  public function __construct(array $configuration, $plugin_id, $plugin_definitio, TimezoneClockService $timezoneClockService) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->timezoneClockService = $timezoneClockService;
    // $this->configFactory = $configFactory;
  }

  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('timezone_clock.service')
    );
  }

 public function build() {
    // $config = $this->configuration;
    // $current_time = $this->timezoneClockService->getCurrentTime();

    $config = \Drupal::config('timezone_clock.admin_settings');
    // $option1 = $config->get('country');
    // $option2 = $config->get('city');
    $time_data = $this->timezoneClockService->getCurrentTime();
    $date = $time_data['date'];
    $time = $time_data['time'];
    return [
      '#markup' => $this->t('<h1>@time</h1>@date<br>Time in @city , @country', [
        '@country' => $config->get('country'),
        '@city' => $config->get('city'),
        '@time' =>  $time_data['time'],
        '@date' =>  $time_data['date'],
      ]),
    ];
  }
}
