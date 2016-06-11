<?php
/**
 * Plugin Name: MainPlugin
 * Plugin URI:
 * Description: MainPlugin
 * Version: 1.0.0
 * Author: Yossi Eynav
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: MainPlugin
 *
 * @author Yossi Eynav
 */


namespace MainPlugin;

use MainPlugin\Core\PluginManager;
use MainPlugin\Core\Router;

PluginManager::getInstance();
Router::getInstance();


