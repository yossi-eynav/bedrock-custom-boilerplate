<?php
/**
 * Plugin Name: MainPlugin
 * Plugin URI:
 * Description: MainPlugin
 * Version: 1.0.0
 * Author: restart Group
 * Author URI: http://restartgroup.co
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: MainPlugin
 *
 * @author restart Group
 */


namespace MainPlugin;

use MainPlugin\Core\PluginManager;
use MainPlugin\Core\Controller\CTRLManager;

PluginManager::getInstance();
CTRLManager::getInstance();



