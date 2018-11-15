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

class EternityRose_NewsletterWidget_Block_Form extends Mage_Newsletter_Block_Subscribe implements Mage_Widget_Block_Interface
{
    protected $_template = "newsletterwidget/form.phtml";

    public function getCta()
    {
        return $this->getData('cta');
    }

    public function getSource()
    {
        return $this->getData('source');
    }
}
