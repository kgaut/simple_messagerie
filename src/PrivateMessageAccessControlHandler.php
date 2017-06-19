<?php

namespace Drupal\simple_messagerie;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Private message entity.
 *
 * @see \Drupal\simple_messagerie\Entity\PrivateMessage.
 */
class PrivateMessageAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\simple_messagerie\Entity\PrivateMessageInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished private message entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published private message entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit private message entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete private message entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add private message entities');
  }

}
