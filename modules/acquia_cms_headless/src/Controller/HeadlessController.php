<?php

namespace Drupal\acquia_cms_headless\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Defines a route controller providing a simple tour of Acquia CMS.
 *
 * @internal
 *   This is a totally internal part of Acquia CMS and may be changed in any
 *   way, or removed outright, at any time without warning. External code should
 *   not use this class!
 */

final class HeadlessController extends ControllerBase {

  /**
   * Returns a renderable array for the api dashboard page.
   */
  public function build() {
    return [
      '#theme' => 'acquia_cms_headless',
      '#attached' => [
        'library' => [
          'acquia_cms_headless/acquia_cms_headless',
        ],
      ],
    ];
  }

}
