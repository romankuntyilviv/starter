<?php

namespace Drupal\starter_custom\Plugin\EntityViewBuilder;

use Drupal\node\NodeInterface;
use Drupal\server_general\EntityViewBuilder\NodeViewBuilderAbstract;
use Drupal\server_general\TitleAndLabelsTrait;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * The "Node Group" plugin.
 *
 * @EntityViewBuilder(
 *   id = "node.group",
 *   label = @Translation("Node - Group"),
 *   description = "Node view builder for Group bundle."
 * )
 */
class NodeGroup extends NodeViewBuilderAbstract {

  use TitleAndLabelsTrait;

  /**
   * Build full view mode.
   *
   * @param array $build
   *   The existing build.
   * @param \Drupal\node\NodeInterface $entity
   *   The entity.
   *
   * @return array
   *   Render array.
   */
  public function buildFull(array $build, NodeInterface $entity) {
    if ($this->currentUser->isAuthenticated()) {
      $text = $this->t('Hi @name, click here if you would like to subscribe to this group called @label.',
        [
          '@name' => $this->currentUser->getAccountName(),
          '@label' => $entity->label(),
        ]
      );
      $url = Url::fromRoute('og.subscribe',
        [
          'entity_type_id' => 'node',
          'group' => $entity->get('nid')->getValue()[0]['value'],
          'og_membership_type' => 'default',
        ],
        [
          'attributes' => [
            'class' => [
              'subscribe-link',
            ],
          ],
        ]
      );
      $element = [
        '#theme' => 'node_group',
        '#content' => Link::fromTextAndUrl($text, $url),
      ];

      $build[] = $element;

      return $build;
    }

    return $build;
  }

}
