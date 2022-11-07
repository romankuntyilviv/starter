<?php

namespace Drupal\Tests\server_general\ExistingSite;

use weitzman\DrupalTestTraits\ExistingSiteBase;

/**
 * A model test case using traits from Drupal Test Traits.
 */
class GeneralTest extends ExistingSiteBase {

  /**
   * An example test method; note that Drupal API's and Mink are available.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   * @throws \Drupal\Core\Entity\EntityMalformedException
   * @throws \Behat\Mink\Exception\ExpectationException
   */
  public function testNews() {
    $author = $this->createUser();

    $node = $this->createNode([
      'title' => 'Group',
      'type' => 'group',
      'uid' => $author->id(),
    ]);
    $this->assertEquals($author->id(), $node->getOwnerId());

    $this->drupalGet($node->toUrl());
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalLogin($author);
    $this->drupalGet($node->toUrl());
    $this->assertSession()->elementExists('css', '.subscribe-link');
    $this->drupalGet($node->toUrl('edit-form'));
  }

}
