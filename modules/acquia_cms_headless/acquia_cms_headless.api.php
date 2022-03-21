<?php

/**
 * @file
 * Hooks provided by the acquia_cms_headless module.
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * Alter acquia_cms_headless page behaviour.
 *
 * Acquia CMS headless module provides annotation based plugin which is being used
 * for creating Acquia CMS headless page with wizard that helps users to set/update
 * different contrib modules configuration from single place, it also provides
 * module specific config with save and ignore option individually.
 *
 * Possible uses:
 * - Create plugin using AcquiaCmsTour
 *
 * @AcquiaCmsTour(
 *   id = "cohesion",
 *   label = @Translation("Site Studio"),
 *   weight = 8
 * )
 * id - This should the module machine name whose configuration need to be
 * provided on acquia cms tour page.
 *
 * weight - This is being used to sort the plugin and show on wizard and
 * tour page accordingly.
 *
 * For more details see @ \Drupal\acquia_cms_headless\Plugin\AcquiaCmsHeadless.
 *
 * @ingroup acquia_cms_headless
 */

/**
 * Alter acquia_cms_headless plugin definitions.
 *
 * @param array $definitions
 *   The array of acquia_cms_headless plugin definitions, keyed by plugin ID.
 *
 * @see \Drupal\acquia_cms_headless\Annotation\AcquiaCmsHeadless
 * @see \Drupal\acquia_cms_headless\AcquiaCmsHeadlessManager
 */
function hook_acquia_cms_headless_info_alter(array &$definitions) {
  if (isset($definitions['google_tag'])) {
    $definitions['google_tag']['weight'] = 1;
    $definitions['google_tag']['class'] = '\Drupal\custom_module\Form\GoogleForm';
  }
}

/**
 * Alters the consumer list builder.
 *
 * @param array $data
 *   The data to alter. It's either the header or a data row.
 * @param array $context
 *   Contains a key 'type' that can be either 'header' or 'row'. It can also
 *   contain a key 'entity' containing the consumer entity in the row.
 */
function hook_consumes_list_alter(array &$data, array $context) {
  if ($context['type'] === 'header') {
    $data['scopes'] = t('Foo');
  }
  elseif ($context['type'] === 'row') {
    $entity = $context['entity'];
    $data['confidential'] = $entity->get('foo')->value;
  }
}

/**
 * @} End of "addtogroup hooks".
 */


/**
 * @} End of "addtogroup hooks".
 */
