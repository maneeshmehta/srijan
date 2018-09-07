<?php
namespace Drupal\ad_blocks\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Provides the 'Sidebar condition' condition.
 *
 * @Condition(
 *   id = "ipaddress",
 *   label = @Translation("IP Address"),
 *   context = {
 *     "node" = @ContextDefinition(
 *        "entity:node",
 *        required = TRUE ,
 *        label = @Translation("node")
 *     )
 *   }
 * )
 */
class SidebarCondition extends ConditionPluginBase implements ContainerFactoryPluginInterface {
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }
  /**
   * Creates a new SidebarCondition object.
   *
   * @param array $configuration
   *   The plugin configuration, i.e. an array with configuration values keyed
   *   by configuration option name. The special key 'context' may be used to
   *   initialize the defined contexts by setting it to an array of context
   *   values keyed by context names.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }
  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['ipaddress'] = [
      '#type'          => 'textarea',
      '#title'         => $this->t('IP Address'),
      '#default_value' => $this->configuration['ipaddress'],
      '#description'   => $this->t('Enable this block when ip exist.'),
    ];
    return parent::buildConfigurationForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['ipaddress'] = $form_state->getValue('ipaddress');
    parent::submitConfigurationForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['ipaddress' => '127.0.0.2'] + parent::defaultConfiguration();
  }
  /**
   * Provides a human readable summary of the condition's configuration.
   */
  public function summary() {
    $pages = array_map('trim', explode("\n", $this->configuration['ipaddress']));
    $pages = implode(', ', $pages);
    if (!empty($this->configuration['ipaddress'])) {
      return $this->t('Do not return true on the following pages: @pages', ['@pages' => $pages]);
    }
    return $this->t('Return true on the following pages: @pages', ['@pages' => $pages]);
  }
  
  /**
   * Evaluates the condition and returns TRUE or FALSE accordingly.
   *
   * @return bool
   *   TRUE if the condition has been met, FALSE otherwise.
   */
  public function evaluate() {
	kint($this->configuration['ipaddress']);
    if (empty($this->configuration['ipaddress']) && !$this->isNegated()) {
      return TRUE;
    }
  }
  
  /*public function evaluate() {
    if (empty($this->configuration['types']) && !$this->isNegated()) {
      return TRUE;
    }
    foreach ($this->configuration['types'] as $type) {
      if ($entity_id = \Drupal::routeMatch()->getParameter($type)) {
        return TRUE;
      }
    }
    return FALSE;
  }*/
}
