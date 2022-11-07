<?php

namespace Drupal\starter_custom\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class StarterRouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    if ($route = $collection->get('server_style_guide.style_guide')) {
      $route->setDefaults([
        '_controller' => '\Drupal\starter_custom\Controller\CustomStyleGuideController::styleGuidePage',
      ]);
    }
  }

}
