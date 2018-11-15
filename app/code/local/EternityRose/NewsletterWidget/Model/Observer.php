<?php
/**
 * Mamis
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is available through the world-wide-web at this URL:
 * http://www.mamis.com.au/licencing
 *
 * @category   Mamis
 * @copyright  Copyright (c) by Mamis (http://www.mamis.com.au)
 * @author     Matthew Muscat <matthew@mamis.com.au>
 * @license    http://www.mamis.com.au/licencing
 */

class EternityRose_NewsletterWidget_Model_Observer
{
    // Source field tag configured in mailchimp configuration
    const SOURCE_FIELD_TAG = 'SOURCE';

    public function newsletterSubscriberChange(Varien_Event_Observer $observer)
	{
		$subscriber = $observer->getEvent()->getSubscriber();
        $data = Mage::app()->getRequest()->getParams();

		if (is_array($data) && isset($data['email'])) {
			if (isset($data['name'])) {
                $name = explode(' ', $data['name']);
                $firstName = $name[0];
                $lastName = (isset($name[1])) ? $name[1] : '';

                $subscriber->setSubscriberFirstname($firstName);
                $subscriber->setSubscriberLastname($lastName);
            }
		}

		return $this;
    }

    public function saveMailchimpSourcePage(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();
        $requestParams = Mage::app()->getRequest()->getParams();
        $source = $requestParams['source'];
        $name = explode(' ', $requestParams['name']);
        $firstName = $name[0];
        $lastName = (isset($name[1])) ? $name[1] : '';

        $mergeFieldTag = $event->getMergeFieldTag();

        if ($mergeFieldTag == 'firstname') {
            $event->setMergeFieldValue($firstName);
        }

        if ($mergeFieldTag == 'lastname' && $lastName != '') {
            $event->setMergeFieldValue($lastName);
        }

        if ($mergeFieldTag == self::SOURCE_FIELD_TAG && $source != '') {
            $event->setMergeFieldValue($source);
        }

        return $this;
    }
}
