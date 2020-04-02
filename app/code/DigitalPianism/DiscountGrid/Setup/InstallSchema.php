<?php

namespace DigitalPianism\Discountgrid\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 * @package DigitalPianism\Discountgrid\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install( SchemaSetupInterface $setup, ModuleContextInterface $context )
    {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();
        $connection->addColumn(
            $installer->getTable('sales_order_grid'),
            'coupon_code',
            [
                'type'      => Table::TYPE_TEXT,
                'length'    => 255,
                'comment'   => 'Coupon Code'
            ]
        );

        $connection->addIndex(
            $installer->getTable('sales_order_grid'),
            $installer->getIdxName('sales_order_grid', ['coupon_code']),
            ['coupon_code']
        );

        $connection->addColumn(
            $installer->getTable('sales_order_grid'),
            'discount_amount',
            [
                'type'      => Table::TYPE_DECIMAL,
                'length'    => '12,4',
                'default'   => '0.0000',
                'comment'   => 'Discount Amount'
            ]
        );

        $connection->addIndex(
            $installer->getTable('sales_order_grid'),
            $installer->getIdxName('sales_order_grid', ['discount_amount']),
            ['discount_amount']
        );

        $installer->endSetup();
    }
}