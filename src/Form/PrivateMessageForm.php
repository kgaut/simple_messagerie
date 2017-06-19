<?php

namespace Drupal\simple_messagerie\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Private message edit forms.
 *
 * @ingroup simple_messagerie
 */
class PrivateMessageForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\simple_messagerie\Entity\PrivateMessage */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Private message.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Private message.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.private_message.canonical', ['private_message' => $entity->id()]);
  }

}
