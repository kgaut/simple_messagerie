<?php

/**
 * @file
 * Contains private_message.page.inc.
 *
 * Page callback for Private message entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Private message templates.
 *
 * Default template: private_message.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_private_message(array &$variables) {
  // Fetch PrivateMessage Entity Object.
  $private_message = $variables['elements']['#private_message'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
