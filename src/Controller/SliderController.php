<?php

namespace Drupal\monks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;

/**
 * Defines SliderController class.
 */
class SliderController extends ControllerBase {

  public function getSliders(Node $node) {
    $sliders = [];

    if ($node->hasField('field_sliders')) {
      foreach ($node->field_sliders as $slider) {
        $paragraphs = [];
        
      }
    }

    return new JsonResponse($sliders);
  }
}