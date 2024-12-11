<?php

namespace Drupal\spotify_lookup;

use Drupal\Core\Config\ConfigFactoryInterface;
use GuzzleHttp\ClientInterface;

/**
 * Service for interacting with the Spotify API.
 */
class SpotifyLookupService {

  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * The configuration factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a SpotifyLookupService object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The configuration factory.
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   */
  public function __construct(ConfigFactoryInterface $config_factory, ClientInterface $http_client) {
    $this->configFactory = $config_factory;
    $this->httpClient = $http_client;
  }

  /**
   * Searches Spotify for the given query.
   *
   * @param string $query
   *   The search query.
   *
   * @return array
   *   An array of search results.
   */
  public function search($query) {
    $config = $this->configFactory->get('spotify_lookup.settings');
    $api_key = $config->get('api_key');

    // Prepare the request.
    $response = $this->httpClient->request('GET', 'https://api.spotify.com/v1/search', [
      'headers' => [
        'Authorization' => 'Bearer ' . $api_key,
      ],
      'query' => [
        'q' => $query,
        'type' => 'track,artist,album',
      ],
    ]);

    $data = json_decode($response->getBody(), TRUE);

    // Process and return the data.
    return $data;
  }

}
