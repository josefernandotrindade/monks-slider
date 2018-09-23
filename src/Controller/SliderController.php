<?php

namespace Drupal\monks\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Drupal\node\Entity\Node;
use Drupal\Component\Utility\Xss;

/**
 * Defines SliderController class.
 */
class SliderController extends ControllerBase {

  /**
   * Gets the slider data associated to a particular node
   *
   * @param Node $node
   * @return JsonResponse
   */
  public function getSliders(Node $node) {
    $sliders = [
      'data' => [],
    ];

    $slider_style = \Drupal::entityManager()->getStorage('image_style')->load('slider');

    if ($node->hasField('field_slider') and !$node->field_slider->isEmpty()) {
      foreach ($node->field_slider as $slide) {
        $entity = $slide->entity;

        $title = $entity->field_slider_title->first()->getValue();
        $body = $entity->field_slider_body->first()->getValue();
        $image = $entity->field_slider_image->first()->entity;

        $sliders['data'][] = [
          'title' => check_markup($title['value'], 'slider_html'),
          'body' =>  check_markup($body['value'], 'slider_html'),
          'image' => $slider_style->buildUrl($image->getFileUri()),
        ];
      }
    }

    return new JsonResponse($sliders);
  }
}
