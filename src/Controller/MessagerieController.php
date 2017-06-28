<?php

namespace Drupal\simple_messagerie\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManager;
use Drupal\Core\Entity\EntityFormBuilder;

/**
 * Class MessagerieController.
 */
class MessagerieController extends ControllerBase {

  /**
   * Drupal\Core\Entity\EntityTypeManager definition.
   *
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;
  /**
   * Drupal\Core\Entity\EntityFormBuilder definition.
   *
   * @var \Drupal\Core\Entity\EntityFormBuilder
   */
  protected $entityFormBuilder;

  /**
   * Constructs a new MessagerieController object.
   */
  public function __construct(EntityTypeManager $entity_type_manager, EntityFormBuilder $entity_form_builder) {
    $this->entityTypeManager = $entity_type_manager;
    $this->entityFormBuilder = $entity_form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('entity.form_builder')
    );
  }

  /**
   * Inbox.
   *
   * @return string
   *   Return Hello string.
   */
  public function inbox() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: inbox')
    ];
  }
  /**
   * Newmessage.
   *
   * @return string
   *   Return Hello string.
   */
  public function newMessage() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: newMessage')
    ];
  }
  /**
   * Trash.
   *
   * @return string
   *   Return Hello string.
   */
  public function trash() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: trash')
    ];
  }

}
