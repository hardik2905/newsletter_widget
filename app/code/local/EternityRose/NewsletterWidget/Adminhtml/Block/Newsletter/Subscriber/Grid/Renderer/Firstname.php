<?php
/**
 * Mamis.IT
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is available through the world-wide-web at this URL:
 * http://www.mamis.com.au/licencing
 *
 * @category   Mamis
 * @copyright  Copyright (c) 2016 by Mamis.IT (http://www.mamis.com.au)
 * @author     Matthew Muscat <matthew@mamis.com.au>
 * @license    http://www.mamis.com.au/licencing
 */

class EternityRose_NewsletterWidget_Adminhtml_Block_Newsletter_Subscriber_Grid_Renderer_Firstname extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		if ($row->getType() == 2) {
			$value = $row->getCustomerFirstname();
		}
		else {
			$value = $row->getSubscriberFirstname();
		}

		return $value ? $value : '---';
	}
}
