<?php

/**
 * @file
 * Contains \Drupal\ad_blocks\Plugin\Block\AdBlock.
 */
/**
 * Provides a 'Ad' Block
 *
 * @Block(
 *   id = "gptadblockyblockyblock",
 *   admin_label = @Translation("GPT Ad Block"),
 * )
 */
namespace Drupal\ad_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;

class AdBlock extends BlockBase {

  /**
   *{@inheritdoc}
   */
  public function build() {

    return array(
        '#markup' => '<div id="adsservice" class="adsservice" ></div>'
    );

  }

}
?>