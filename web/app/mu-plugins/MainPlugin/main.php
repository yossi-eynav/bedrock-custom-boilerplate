<?php
/**
 * Plugin Name: MainPlugin
 * Plugin URI: http://restartit.co.il
 * Description: MainPlugin
 * Version: 1.0.0
 * Author: Restart IT
 * Author URI: http://restartit.co.il
 * Requires at least: 4.0
 * Tested up to: 4.2
 *
 * Text Domain: MainPlugin
 * Domain Path: /i18n/languages/
 *
 * @author restartIT
 */

use MainPlugin\Core\PluginManager;
require_once('autoload.php');

$pluginManager = PluginManager::getInstance();


