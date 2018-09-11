<?php
namespace Drupal\ad_blocks\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Cache\Cache;
/**
 * Provides the 'Sidebar condition' condition.
 *
 * @Condition(
 *   id = "ipaddress",
 *   label = @Translation("IP Address"),
 * )
 */
class SidebarCondition extends ConditionPluginBase implements ContainerFactoryPluginInterface {
  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * Creates a new IpAddress instance.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack.
   * @param array $configuration
   *   The plugin configuration.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(RequestStack $request_stack, array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $container->get('request_stack'),
      $configuration,
      $plugin_id,
      $plugin_definition
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['ipaddress'] = [
      '#type'          => 'textarea',
      '#title'         => $this->t('IP Address'),
      '#default_value' => $this->configuration['ipaddress'],
      '#description' => $this->t("Enter one IP Address per line. An example IP Adress for localhost is %ipAddress.", [
        '%ipAddress' => '127.0.0.1'
      ]),
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
   * Provides a human readable summary of the condition's configuration.
   */
  public function summary() {
    $ipaddress = array_map('trim', explode("\n", $this->configuration['ipaddress']));
    $ipaddress = implode(', ', $ipaddress);
    if (!empty($this->configuration['ipaddress'])) {
      return $this->t('Do not return true on the following ipaddress: @ipaddress', ['@ipaddress' => $ipaddress]);
    }
    return $this->t('Return true on the following ipaddress: @ipaddress', ['@ipaddress' => $ipaddress]);
  }
  
  /**
   * Evaluates the condition and returns TRUE or FALSE accordingly.
   *
   * @return bool
   *   TRUE if the condition has been met, FALSE otherwise.
   */
  public function evaluate() {
    if (empty($this->configuration['ipaddress']) && $this->configuration['negate'] == False) {
      return TRUE;
    } else {
      $ipAddress = array_map('trim', explode("\n", $this->configuration['ipaddress']));
      $ip = $this->requestStack->getCurrentRequest()->getClientIp();
      $return = TRUE;
      if (!in_array($ip, $ipAddress))  {
        $return = FALSE;
        }
      return $return;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts() {
    return Cache::mergeContexts(parent::getCacheContexts(), array('ip:ipaddress'));
  }
}
