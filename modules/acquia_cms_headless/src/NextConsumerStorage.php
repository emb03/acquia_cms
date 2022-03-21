<?php

namespace Drupal\acquia_cms_headless;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\Sql\SqlContentEntityStorage;

class NextConsumerStorage extends SqlContentEntityStorage {

  /**
   * {@inheritdoc}
   */
  public function restore(EntityInterface $entity) {
    /** @var \Drupal\acquia_cms_headless\Entity\NextConsumer $entity */
    // Special handling for the secret field added by simple_oauth, make sure that it is not hashed again.
    if ($entity->hasField('secret')) {
      $entity->get('secret')->pre_hashed = TRUE;
    }
    parent::restore($entity);
  }

}
