<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helpers/helper.php';
require_once __DIR__ . '/helpers/loginHelper.php';

$list		= ModMenuLoginHelper::getList($params);
$base		= ModMenuLoginHelper::getBase($params);
$active		= ModMenuLoginHelper::getActive($params);
$active_id 	= $active->id;
$path		= $base->tree;

$showAll	= $params->get('showAllChildren');
$class_sfx	= htmlspecialchars($params->get('class_sfx'));

require_once JPATH_SITE . '/components/com_users/helpers/route.php';
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$type = ModMenuLoginFormHelper::getType();
$return= ModMenuLoginFormHelper::getReturnURL($params, $type);

$user= JFactory::getUser();

$loginFormLayout = 'login_form';
if (!$user->guest)
{
  $loginFormLayout .= '_logout';
}

if (count($list))
{
?>
  <div class="mod-menu-login">
    <?php
      require JModuleHelper::getLayoutPath('mod_menu_login', $params->get('layout', 'default'));
      require JModuleHelper::getLayoutPath('mod_menu_login', $loginFormLayout);
    ?>
  </div>  
<?php
}
