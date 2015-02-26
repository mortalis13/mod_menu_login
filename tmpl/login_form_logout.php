<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="navbar-form pull-right menu-form-inline">
  <div class="logout-box">
    <div class="login-greeting hidden-phone">
      <?php echo JText::_('MOD_MENU_LOGIN_USER_GREETING').", ".htmlspecialchars($user->get('name')); ?>
    </div>
    <div class="logout-button">
      <input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
      <input type="hidden" name="option" value="com_users" />
      <input type="hidden" name="task" value="user.logout" />
      <input type="hidden" name="return" value="<?php echo $return; ?>" />
      <?php echo JHtml::_('form.token'); ?>
    </div>
  </div>
</form>
