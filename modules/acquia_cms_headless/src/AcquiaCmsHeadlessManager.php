<?php

namespace Drupal\acquia_cms_headless;

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;

/**
 * AcquiaCmsHeadless plugin manager.
 */
class AcquiaCmsHeadlessManager extends DefaultPluginManager {

  /**
   * Constructs AcquiaCmsHeadlessManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/AcquiaCmsHeadless',
      $namespaces,
      $module_handler,
      'Drupal\acquia_cms_headless\AcquiaCmsHeadlessInterface',
      'Drupal\acquia_cms_headless\Annotation\AcquiaCmsHeadless'
    );
    $this->alterInfo('acquia_cms_headless_info');
    $this->setCacheBackend($cache_backend, 'acquia_cms_headless_plugins');
  }

  /**
   * {@inheritdoc}
   */
  protected function findDefinitions(): array {
    // Sort plugin by its weight.
    $definitions = parent::findDefinitions();
    uasort($definitions, [
      'Drupal\Component\Utility\SortArray',
      'sortByWeightElement',
    ]);
    return $definitions;
  }

  /**
   * {@inheritdoc}
   */
  public function getHeadlessManagerPlugin(): array {
    $options = [];
    foreach ($this->getDefinitions() as $definition) {
      $options[$definition['id']] = $definition;
    }
    return $options;
  }

}
