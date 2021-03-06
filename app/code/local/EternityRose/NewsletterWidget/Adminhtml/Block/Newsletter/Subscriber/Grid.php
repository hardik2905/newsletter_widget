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

class EternityRose_NewsletterWidget_Adminhtml_Block_Newsletter_Subscriber_Grid extends Mage_Adminhtml_Block_Newsletter_Subscriber_Grid
{
	protected function _prepareCollection()
	{
        $collection = Mage::getResourceSingleton('newsletter/subscriber_collection');
        $collection
            ->showCustomerInfo()
            ->addSubscriberTypeField()
            ->showStoreInfo();

        if($this->getRequest()->getParam('queue', false)) {
            $collection->useQueue(Mage::getModel('newsletter/queue')
                ->load($this->getRequest()->getParam('queue')));
        }

        $this->setCollection($collection);

		/* 	we have to copy the following lines from Mage_Adminhtml_Block_Widget_Grid because we need
			a new collection but Mage_Adminhtml_Block_Newsletter_Subscriber_Grid would overwrite it */
        if ($this->getCollection()) {

            $this->_preparePage();

            $columnId = $this->getParam($this->getVarNameSort(), $this->_defaultSort);
            $dir      = $this->getParam($this->getVarNameDir(), $this->_defaultDir);
            $filter   = $this->getParam($this->getVarNameFilter(), null);

            if (is_null($filter)) {
                $filter = $this->_defaultFilter;
            }

            if (is_string($filter)) {
                $data = $this->helper('adminhtml')->prepareFilterString($filter);
                $this->_setFilterValues($data);
            }
            else if ($filter && is_array($filter)) {
                $this->_setFilterValues($filter);
            }
            else if(0 !== sizeof($this->_defaultFilter)) {
                $this->_setFilterValues($this->_defaultFilter);
            }

            if (isset($this->_columns[$columnId]) && $this->_columns[$columnId]->getIndex()) {
                $dir = (strtolower($dir)=='desc') ? 'desc' : 'asc';
                $this->_columns[$columnId]->setDir($dir);
                $this->_setCollectionOrder($this->_columns[$columnId]);
            }

            if (!$this->_isExport) {
                $this->getCollection()->load();
                $this->_afterLoadCollection();
            }
        }
    }

	protected function _prepareColumns()
	{
		// prepare columns and sort them by order (see Mage_Adminhtml_Block_Widget_Grid)
		parent::_prepareColumns();

		// remove old columns
		$this->removeColumn('gender'); // futureproof
        $this->removeColumn('lastname');
        $this->removeColumn('firstname');

		$this->addColumnAfter('firstname', array(
			'header'    => Mage::helper('newsletter')->__('Firstname'),
            'index'     => 'customer_firstname',
			'renderer'	=> 'EternityRose_NewsletterWidget_Adminhtml_Block_Newsletter_Subscriber_Grid_Renderer_Firstname'
		), 'firstname');

		$this->addColumnAfter('lastname', array(
			'header'    => Mage::helper('newsletter')->__('Lastname'),
            'index'     => 'customer_lastname',
			'renderer'	=> 'EternityRose_NewsletterWidget_Adminhtml_Block_Newsletter_Subscriber_Grid_Renderer_Lastname'
		), 'lastname');

		// manually sort again, that our custom order works
		$this->sortColumnsByOrder();

        return $this;
    }
}
