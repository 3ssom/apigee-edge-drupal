<?php

namespace Drupal\apigee_edge;

use Drupal\apigee_edge\Annotation\CredentialsStorage;
use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;

/**
 * Provides a credentials storage plugin manager.
 *
 * @see \Drupal\apigee_edge\Annotation\CredentialsStorage
 * @see \Drupal\apigee_edge\CredentialsStoragePluginInterface
 * @see plugin_api
 */
class CredentialsStorageManager extends DefaultPluginManager {

  /**
   * Constructs a CredentialsStorageManager object.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler to invoke the alter hook with.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/CredentialsStorage',
      $namespaces,
      $module_handler,
      CredentialsStoragePluginInterface::class,
      CredentialsStorage::class
    );

    $this->alterInfo('credentials_storage_info');
    $this->setCacheBackend($cache_backend, 'credentials_storage');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

}