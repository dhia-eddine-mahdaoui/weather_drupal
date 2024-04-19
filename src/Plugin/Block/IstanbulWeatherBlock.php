<?php

namespace Drupal\istanbul_weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use GuzzleHttp\ClientInterface;

/**
 * Provides a 'Istanbul Weather' Block.
 *
 * @Block(
 *   id = "istanbul_weather_block",
 *   admin_label = @Translation("Istanbul Weather Block"),
 *   category = @Translation("Custom")
 * )
 */
class IstanbulWeatherBlock extends BlockBase implements ContainerFactoryPluginInterface {
  /**
   * The HTTP client.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * Constructs a new IstanbulWeatherBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \GuzzleHttp\ClientInterface $http_client
   *   The HTTP client.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ClientInterface $http_client) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->httpClient = $http_client;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('http_client')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Retrieve API key from settings.php
    $api_key = \Drupal::service('settings')->get('istanbul_weather_api_key');

    $config = [
      'appid' => $api_key,  // Use the API key from settings.php
      'q' => 'Istanbul',
      'units' => 'metric'
    ];

    try {
      $response = $this->httpClient->request('GET', 'http://api.openweathermap.org/data/2.5/weather', ['query' => $config]);
      $data = json_decode($response->getBody(), TRUE);
      
      return [
        '#theme' => 'istanbul_weather_block',
        '#weather' => $data,
        '#cache' => [
          'max-age' => 3600, // Cache for 1 hour
        ],
        '#attached' => [
          'library' => [
            'istanbul_weather/weather-styling',
          ],
        ],
      ];
    } catch (\Exception $e) {
      return [
        '#markup' => $this->t('Unable to retrieve weather information.'),
      ];
    }
  }
}
