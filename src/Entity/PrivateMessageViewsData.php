<?php

namespace Drupal\simple_messagerie\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Private message entities.
 */
class PrivateMessageViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
