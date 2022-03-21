<?php

namespace Drupal\acquia_cms_headless\Entity\Routing;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider;
use Symfony\Component\Routing\Route;

class HtmlRouteProvider extends DefaultHtmlRouteProvider {

  /**
   * {@inheritdoc}
   */
  public function getRoutes(EntityTypeInterface $entity_type) {
    $collection = parent::getRoutes($entity_type);
    $route = new Route($entity_type->getLinkTemplate('make-default-form'));
    $route
      ->addDefaults([
        '_entity_form' => 'nextconsumer.make-default',
        '_title_callback' => '\Drupal\Core\Entity\Controller\EntityController::title',
      ])
      ->setRequirement('_entity_access', 'nextconsumer.update')
      ->setOption('parameters', ['nextconsumer' => ['type' => 'entity:nextconsumer']]);
    $collection->add(
      'entity.nextconsumer.make_default_form',
      $route
    );
    return $collection;
  }

}
