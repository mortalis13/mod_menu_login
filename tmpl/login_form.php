
<?php
	defined('_JEXEC') or die;
?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" class="pull-right menu-form-inline">
	<div class="userdata">
		<?php $usersConfig = JComponentHelper::getParams('com_users'); ?>

		<div class="controls">
			<?php if ($usersConfig->get('allowUserRegistration')) : 
				$link=JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute());
			?>
				<a href="<?php echo $link ?>" class="btn btn-primary register-button">
					<?php echo JText::_('MOD_MENU_LOGIN_REGISTER') ?>
				</a>
			<?php endif; ?>

			<div class="input-prepend">
				<span class="add-on">
					<span class="icon-user"></span>
					<label for="modlgn-username" class="element-invisible"><?php echo JText::_('MOD_MENU_LOGIN_FORM_USERNAME'); ?></label>
				</span>
				<input id="modlgn-username" type="text" name="username" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_MENU_LOGIN_FORM_USERNAME') ?>" />
			</div>

			<div class="input-prepend">
				<span class="add-on">
					<span class="icon-lock">
					</span>
						<label for="modlgn-passwd" class="element-invisible"><?php echo JText::_('JGLOBAL_PASSWORD'); ?>
					</label>
				</span>
				<input id="modlgn-passwd" type="password" name="password" class="input-small" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
			</div>

			<button type="submit" tabindex="0" name="Submit" class="btn btn-primary login-button"><?php echo JText::_('JLOGIN') ?></button>
		</div>

		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.login" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>