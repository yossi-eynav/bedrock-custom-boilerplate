<?php
/**
 * Plugin Name: SearchPlugin
 * Plugin URI:
 * Description: SearchPlugin
 * Version: 1.0.0
 * Author: Yossi Eynav
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: SearchPlugin
 *
 * @author Yossi Eynav
 */


use SearchPlugin\Core\Router;
use SearchPlugin\Core\PluginManager;

PluginManager::getInstance();
$router = Router::getInstance();
