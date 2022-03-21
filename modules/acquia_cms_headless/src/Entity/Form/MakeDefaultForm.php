<?php

namespace Drupal\acquia_cms_headless\Entity\Form;

use Drupal\acquia_cms_headless\Entity\NextConsumer;
use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class MakeDefaultForm extends ContentEntityConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to make %consumer the default consumer?', ['%consumer' => $this->entity->label()]);
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->t('The consumer currently marked as default will lose this property, since there can only be one default consumer. This may break current assumptions in existing client-side applications.');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return Url::fromRoute('entity.nextconsumer.collection');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Make Default');
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Make the submitted entity the new default.
    /** @var \Drupal\acquia_cms_headless\Entity\NextConsumer $entity */
    $entity = $this->getEntity();
    if ($entity->get('is_default')->value) {
      // This is already the default. Do nothing.
      return;
    }
    $entity->set('is_default', TRUE);
    $entity->save();
  }

}
