<?php

namespace Drupal\musicsearch;

use Drupal\spotify_lookup\SpotifyLookupService;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Service for searching music across different providers.
 */
class MusicSearchService {

  /**
   * The Spotify lookup service.
   *
   * @var \Drupal\spotify_lookup\SpotifyLookupService
   */
  protected $spotifyService;

  /**
   * Constructs a MusicSearchService object.
   *
   * @param \Drupal\spotify_lookup\SpotifyLookupService $spotify_service
   *   The Spotify lookup service.
   */
  public function __construct(SpotifyLookupService $spotify_service) {
    $this->spotifyService = $spotify_service;
  }

  /**
   * Factory method for dependency injection.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('spotify_lookup.spotify_service')
    );
  }

  /**
   * Searches for music based on the query string.
   *
   * @param string $query
   *   The search query.
   *
   * @return array
   *   An array of search results.
   */
  public function search($query) {
    // For now, we'll just use Spotify.
    return $this->spotifyService->search($query);
  }

}
