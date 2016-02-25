<?php
/**
 * Plugin Name: SearchPlugin
 * Plugin URI:
 * Description: SearchPlugin
 * Version: 1.0.0
 * Author: restart Group
 * Author URI: http://restartgroup.co
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: SearchPlugin
 *
 * @author restart Group
 */


use SearchPlugin\Core\Controller\CTRLManager;
use SearchPlugin\Core\PluginManager;

PluginManager::getInstance();
$controllerManager = CTRLManager::getInstance();
