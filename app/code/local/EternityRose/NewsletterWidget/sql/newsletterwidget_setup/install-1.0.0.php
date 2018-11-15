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

$installer = $this;
$installer->startSetup();

// add additional columns to "newsletter_subscriber" table

$this->getConnection()->addColumn(
    $this->getTable('newsletter/subscriber'),
    'subscriber_firstname',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'comment' => 'First Name'
    )
);

$this->getConnection()->addColumn(
    $this->getTable('newsletter/subscriber'),
    'subscriber_lastname',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length' => 255,
        'nullable' => true,
        'comment' => 'Last Name'
    )
);

$installer->endSetup();
