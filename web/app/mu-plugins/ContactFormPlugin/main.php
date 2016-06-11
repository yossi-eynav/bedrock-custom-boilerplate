<?php
/**
 * Plugin Name: ContactFormPlugin
 * Plugin URI:
 * Description: ContactFormPlugin
 * Version: 1.0.0
 * Author: restart Group
 * Author URI: http://restartgroup.co
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: ContactFormPlugin
 * Domain Path: /i18n/languages/
 *
 * @author restart Group
 */


use ContactFormPlugin\Core\Router;
use ContactFormPlugin\Core\PluginManager;



PluginManager::getInstance();
$router = Router::getInstance();
