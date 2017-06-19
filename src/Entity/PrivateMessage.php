<?php

namespace Drupal\simple_messagerie\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Private message entity.
 *
 * @ingroup simple_messagerie
 *
 * @ContentEntityType(
 *   id = "private_message",
 *   label = @Translation("Private message"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\simple_messagerie\PrivateMessageListBuilder",
 *     "views_data" = "Drupal\simple_messagerie\Entity\PrivateMessageViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\simple_messagerie\Form\PrivateMessageForm",
 *       "add" = "Drupal\simple_messagerie\Form\PrivateMessageForm",
 *       "edit" = "Drupal\simple_messagerie\Form\PrivateMessageForm",
 *       "delete" = "Drupal\simple_messagerie\Form\PrivateMessageDeleteForm",
 *     },
 *     "access" = "Drupal\simple_messagerie\PrivateMessageAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\simple_messagerie\PrivateMessageHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "private_message",
 *   admin_permission = "administer private message entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/private_message/{private_message}",
 *     "add-form" = "/admin/structure/private_message/add",
 *     "edit-form" = "/admin/structure/private_message/{private_message}/edit",
 *     "delete-form" = "/admin/structure/private_message/{private_message}/delete",
 *     "collection" = "/admin/structure/private_message",
 *   },
 *   field_ui_base_route = "private_message.settings"
 * )
 */
class PrivateMessage extends ContentEntityBase {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'from' => \Drupal::currentUser()->id(),
      'read' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('subject')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('subject', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('from')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('from')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('from', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('from', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isRead() {
    return (bool) $this->getEntityKey('read');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($read = TRUE) {
    $this->set('read', $read ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['initial_message'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Message initial'))
      ->setSetting('target_type', 'private_message')
      ->setSetting('handler', 'default')
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayConfigurable('view', TRUE)
      ->setDefaultValue(0);

    $fields['from'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Expediteur'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayConfigurable('form', FALSE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['to'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Destinataire'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['subject'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Sujet'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['read'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Message lu'))
      ->setDescription(t('A boolean indicating whether the Private message has been read.'))
      ->setDefaultValue(FALSE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
