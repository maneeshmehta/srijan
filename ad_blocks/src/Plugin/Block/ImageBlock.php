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
    $form['image_title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#default_value' => isset($config['image_title'])? $config['image_title'] : '',
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
    $this->setConfigurationValue('image_title', $form_state->getValue('image_title'));
    $this->setConfigurationValue('desc', $form_state->getValue('desc'));
  }
  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();
    $image1 = NULL;
    $image = isset($config['image']) ? $config['image'] : '';
    if(!empty($image)) {
      $file = \Drupal\file\Entity\File::load(end($image));
      $variables = [
        'style_name' => 'thumbnail',
        'uri' => $file->getFileUri(),
      ];

      // The image.factory service will check if our image is valid.
      $image = \Drupal::service('image.factory')->get($file->getFileUri());
      if ($image->isValid()) {
        $variables['width'] = $image->getWidth();
        $variables['height'] = $image->getHeight();
      }
      else {
        $variables['width'] = $variables['height'] = NULL;
      }

      $logo_render_array = [
        '#theme' => 'image_style',
        '#width' => $variables['width'],
        '#height' => $variables['height'],
        '#style_name' => $variables['style_name'],
        '#uri' => $variables['uri'],
      ];
      $image1 = \Drupal::service('renderer')->render($logo_render_array);
    }
    $title = isset($config['image_title']) ? $config['image_title'] : '';
    $desc = isset($config['desc']) ? $config['desc'] : '';
    return [
      '#theme' =>'ad_blocks',
      '#image' => $image1,
      '#image_title' => $title,
      '#desc' => $desc
    ];
  }
}
