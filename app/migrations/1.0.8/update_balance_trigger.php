<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class ProductsMigration_108
 */
class UpdateBalanceTriggerMigration_108 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        $conn = self::$connection;

        $sql  = "CREATE TRIGGER `update_balance__` AFTER INSERT ON `payment`
                FOR EACH ROW update customers
                set balance = balance+new.amount
                 where id = new.customer_id";

        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
