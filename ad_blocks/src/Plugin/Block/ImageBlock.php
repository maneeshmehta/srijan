<?php
/**
 * @file
 * Contains \Drupal\article\Plugin\Block\ContactBlock.
 */
namespace Drupal\ad_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;  
/**
 * Provides a 'contact' block.
 *
 * @Block(
 *   id = "contact_block",
 *   admin_label = @Translation("Add Image"),
 *   category = @Translation("Custom contact us block")
 * )
 */
class ImageBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    // Retrieve existing configuration for this block.
    $config = $this->getConfiguration();
    // Add a form field to the existing block configuration form.
    $form['image'] = array(
      '#type' => 'managed_file',
      '#upload_location' => 'public://images/',
      '#title' => $this->t('Image'),
      '#description' => t("Image to show "),
      '#default_value' => $this->configuration['image'],
      '#upload_validators' => array(
        'file_validate_extensions' => array('gif png jpg jpeg'),
        'file_validate_size' => array(25600000),
      ),
    );
    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => isset($config['title'])? $config['title'] : '',
    );
    $form['desc'] = array(
      '#type' => 'textfield',
      '#title'=> t('Desc'),
      '#default_value' => isset($config['desc'])? $config['desc'] : '',
    );
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('image', $form_state->getValue('image'));
    $this->setConfigurationValue('title', $form_state->getValue('title'));
    $this->setConfigurationValue('desc', $form_state->getValue('desc'));
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $image = isset($config['image']) ? $config['image'] : '';
    $title = isset($config['title']) ? $config['title'] : '';
    $desc = isset($config['desc']) ? $config['desc'] : '';
   
    return array(
      '#markup' => $this->t('Image : @image Title: @title. Desc: @desc', array('@image'=> $image,'@title'=> $title,'@desc'=> $desc)),
    );
  }
}
