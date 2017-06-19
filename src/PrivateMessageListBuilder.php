<?php

namespace Drupal\simple_messagerie;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Private message entities.
 *
 * @ingroup simple_messagerie
 */
class PrivateMessageListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Private message ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\simple_messagerie\Entity\PrivateMessage */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.private_message.edit_form',
      ['private_message' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
