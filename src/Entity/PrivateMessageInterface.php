<?php

namespace Drupal\simple_messagerie\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Private message entities.
 *
 * @ingroup simple_messagerie
 */
interface PrivateMessageInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Private message name.
   *
   * @return string
   *   Name of the Private message.
   */
  public function getName();

  /**
   * Sets the Private message name.
   *
   * @param string $name
   *   The Private message name.
   *
   * @return \Drupal\simple_messagerie\Entity\PrivateMessageInterface
   *   The called Private message entity.
   */
  public function setName($name);

  /**
   * Gets the Private message creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Private message.
   */
  public function getCreatedTime();

  /**
   * Sets the Private message creation timestamp.
   *
   * @param int $timestamp
   *   The Private message creation timestamp.
   *
   * @return \Drupal\simple_messagerie\Entity\PrivateMessageInterface
   *   The called Private message entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Private message published status indicator.
   *
   * Unpublished Private message are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Private message is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Private message.
   *
   * @param bool $published
   *   TRUE to set this Private message to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\simple_messagerie\Entity\PrivateMessageInterface
   *   The called Private message entity.
   */
  public function setPublished($published);

}
