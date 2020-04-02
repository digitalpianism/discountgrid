<?php

namespace DigitalPianism\DiscountGrid\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class InstallData
 *
 * @package DigitalPianism\DiscountGrid\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function install( ModuleDataSetupInterface $setup, ModuleContextInterface $context )
    {
        $setup->startSetup();
        $connection = $setup->getConnection();
        $gridTable = $setup->getTable('sales_order_grid');
        $orderTable = $setup->getTable('sales_order');
        $connection->query(
            $connection->updateFromSelect(
                $connection->select()
                    ->join(
                        $orderTable,
                        new \Zend_Db_Expr(sprintf('%s.entity_id = %s.entity_id', $gridTable, $orderTable)),
                        [
                            'coupon_code',
                            'discount_amount'
                        ]
                    ),
                $gridTable
            )
        );
        $setup->endSetup();
    }
}