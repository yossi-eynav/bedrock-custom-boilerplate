<?php
/**
 * Plugin Name: ContactFormPlugin
 * Plugin URI:
 * Description: ContactFormPlugin
 * Version: 1.0.0
 * Author: Yossi Eynav
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: ContactFormPlugin
 * Domain Path: /i18n/languages/
 *
 * @author Yossi Eynav
 */


use ContactFormPlugin\Core\Router;
use ContactFormPlugin\Core\PluginManager;



PluginManager::getInstance();
$router = Router::getInstance();
