# Discount Grid Module

A small module to be display discount amount and coupon code on the sales order grid in Magento 2

# Magento 2 behavior

Magento displays the backend order grid using a specific table : `sales_order_grid`

This table has a limited number of columns compared to the table that stores the order information `sales_order`.

There's two main ways of doing the change in this module:

* the first way is to join the collection from `sales_order_grid` with `sales_order` to retrieve the extra column we want. It's not ideal as it involves extra database work.
* the second way, and that's what's implemented in this module, is to add the columns we want to the `sales_order_grid` table and ensure they are synced with `sales_order`

# Module behavior

* First, the `InstallSchema.php` will add the new columns `discount_amount` and `coupon_code` to the `sales_order_grid` table
* Then, the `InstallData.php` will retrieve the existing values for those columns from `sales_order` into `sales_order_grid`.
* The `etc/di.xml` file ensures that `sales_order_grid` new columns are synced with `sales_order` when new orders are being created after the module is installed.
* Finally, the `view/adminhtml/ui_component/sales_order_grid.xml` adds the two new columns to the backend grid and displays them.