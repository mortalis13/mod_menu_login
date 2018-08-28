<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_login
 *
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @since       1.5
 */
class ModMenuLoginFormHelper
{
	/**
	 * Retrieve the url where the user should be returned after logging in
	 *
	 * @param   JRegistry  $params  module parameters
	 * @param   string     $type    return type
	 *
	 * @return string
	 */
	public static function getReturnURL($params, $type)
	{
		$app	= JFactory::getApplication();
		$router = $app::getRouter();
		$url = $app->input->get('return',null,'BASE64');
		
		if($url != null) {
			$url = base64_decode($url);
		}

		if ($url == null 
			&& $itemid = $params->get($type))
		{
			$db		= JFactory::getDbo();
			$query	= $db->getQuery(true)
				->select($db->quoteName('link'))
				->from($db->quoteName('#__menu'))
				->where($db->quoteName('published') . '=1')
				->where($db->quoteName('id') . '=' . $db->quote($itemid));

			$db->setQuery($query);

			if ($link = $db->loadResult())
			{
				if ($router->getMode() == JROUTER_MODE_SEF)
				{
					$url = 'index.php?Itemid=' . $itemid;
				}
				else
				{
					$url = $link . '&Itemid=' . $itemid;
				}
			}
		}

		if (!$url)
		{
			// Stay on the same page
			$uri = clone JUri::getInstance();
			$vars = $router->parse($uri);
			unset($vars['lang']);

			if (isset($vars['Itemid'])){
				$itemid = $vars['Itemid'];
				$menu = $app->getMenu();
				$item = $menu->getItem($itemid);

				if($item->access!=1){
					$url="index.php?option=com_content&view=category&layout=blog&id=8&Itemid=114";
					$db = JFactory::getDbo();

					$query=$db->getQuery(true);
					$query->select('id')->from('#__menu')->where('alias=\'home\'');
					$db->setQuery($query);
					$id=$db->loadResult();

					$item=$menu->getItem($id);
					$url=$item->link.'&Itemid='.$id;

					return base64_encode($url);
				} 
			}

			if ($router->getMode() == JROUTER_MODE_SEF)
			{
				
				if (isset($vars['Itemid']))
				{
					$itemid = $vars['Itemid'];
					$menu = $app->getMenu();
					$item = $menu->getItem($itemid);
					unset($vars['Itemid']);

					if (isset($item) && $vars == $item->query)
					{
						$url = 'index.php?Itemid=' . $itemid;
					}
					else
					{
						$url = 'index.php?' . JUri::buildQuery($vars) . '&Itemid=' . $itemid;
					}
				}
				else
				{
					$url = 'index.php?' . JUri::buildQuery($vars);
				}
			}
			else
			{
				$url = 'index.php?' . JUri::buildQuery($vars);
			}
		}

		return base64_encode($url);
	}

	/**
	 * Returns the current users type
	 *
	 * @return string
	 */
	public static function getType()
	{
		$user = JFactory::getUser();

		return (!$user->get('guest')) ? 'logout' : 'login';
	}

	/**
	 * Get list of available two factor methods
	 *
	 * @return array
	 */
	public static function getTwoFactorMethods()
	{
		require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

		return UsersHelper::getTwoFactorMethods();
	}
}
