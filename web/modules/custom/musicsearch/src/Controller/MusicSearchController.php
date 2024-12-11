<?php

namespace Drupal\musicsearch\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Drupal\musicsearch\MusicSearchService;

/**
 * Controller for music search.
 */
class MusicSearchController extends ControllerBase {

  /**
   * The Music Search service.
   *
   * @var \Drupal\musicsearch\MusicSearchService
   */
  protected $musicSearchService;

  /**
   * Constructs a MusicSearchController object.
   *
   * @param \Drupal\musicsearch\MusicSearchService $music_search_service
   *   The Music Search service.
   */
  public function __construct(MusicSearchService $music_search_service) {
    $this->musicSearchService = $music_search_service;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('musicsearch.music_search_service')
    );
  }

  /**
   * Displays the search form and results.
   */
  public function search(Request $request) {
    $build = [];

    $query = $request->query->get('q');
    if ($query) {
      $results = $this->musicSearchService->search($query);
      $build['results'] = [
        '#theme' => 'item_list',
        '#items' => $results,
      ];
    }

    $build['form'] = $this->formBuilder()->getForm('Drupal\musicsearch\Form\MusicSearchForm');

    return $build;
  }

}
