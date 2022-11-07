<?php

namespace Drupal\starter_custom\Controller;

use Drupal\server_style_guide\Controller\StyleGuideController;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides route responses for the Style Guide pag2e.
 */
class CustomStyleGuideController extends StyleGuideController {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new self(
      $container->get('link_generator')
    );
  }

  /**
   * Returns the "Style Guide22222" page.
   *
   * @return array
   *   A simple renderable array.
   */
  public function styleGuidePage() : array {
    $data = parent::styleGuidePage();
    $elements = [];
    foreach ($data[0]['#elements'] as $row) {
      $elements[] = $row;
      if (isset($row['#title'])) {
        if ($row['#title']['#unique_id'] == 'tags') {
          $elements[] = $this->wrapElementWideContainer($this->getPersonCard(), 'Person card');
          ;
        }
      }
    }
    $data[0]['#elements'] = $elements;

    return $data;
  }

  /**
   * Get Person card.
   *
   * @return array
   *   Render array.
   */
  protected function getPersonCard(): array {
    $image = $this->buildImage($this->getPlaceholderImage(128, 128), 'Card image');

    $card = [
      '#theme' => 'server_theme_person_card',
      '#image' => $image,
      '#name' => 'Jane Cooper',
      '#position' => 'Paradigm Representative',
      '#role' => 'Admin',
      '#email' => 'admin@example.com',
      '#phone' => '+11 111 111 11 11',
    ];

    return $card;
  }

}
