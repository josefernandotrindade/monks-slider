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
    $sliders = [
      'data' => [],
    ];

    if ($node->hasField('field_slider')) {
      foreach ($node->field_slider as $slide) {
        
        $sliders['data'][] = [
          'title' => $slide->entity->field_title->first()->value,
          'image' => NUL,
          'body' => NULL,  
        ];
      }
    }

    return new JsonResponse($sliders);
  }
}