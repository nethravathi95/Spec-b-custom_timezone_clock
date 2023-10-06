<?php
// modules/custom/custom_menu_field/src/CustomMenuFieldService.php

namespace Drupal\custom_menu_field;

use Drupal\Core\Entity\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouteMatchInterface;

class CustomMenuFieldService {
  protected $entityManager;
  protected $routeMatch;

  public function __construct(EntityManagerInterface $entity_manager, RouteMatchInterface $route_match) {
    $this->entityManager = $entity_manager;
    $this->routeMatch = $route_match;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager'),
      $container->get('current_route_match')
    );
  }

  public function addMenuItemField(array &$menu_items, $menu_name) {
    // Check if this is the main navigation menu.
    if ($menu_name === 'main-menu') {
      foreach ($menu_items as &$menu_item) {
        // Load the menu link entity.
        $menu_link = $menu_item['original_link'];
        $menu_item['custom_field'] = $this->loadCustomField($menu_link);
      }
    }
  }

  protected function loadCustomField($menu_link) {
    // Replace 'field_custom_field' with the actual machine name of your custom field.
    return 'Custom Field Value'; // You can load the actual field value here.
  }
}
