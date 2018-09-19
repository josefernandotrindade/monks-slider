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

    $slider_style = \Drupal::entityManager()->getStorage('image_style')->load('slider');

    if ($node->hasField('field_slider')) {
      foreach ($node->field_slider as $slide) {
        $sliders['data'][] = [
          'title' => $slide->entity->field_title->first()->value,
          'body' => $slide->entity->field_body->first()->value,
          'image' => $slider_style->buildUrl($slide->entity->field_slider_image->first()->entity->getFileUri()),  
        ];
      }
    }

    return new JsonResponse($sliders);
  }
}
