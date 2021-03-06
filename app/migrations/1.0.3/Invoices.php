<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class CustomersMigration_103
 */
class InvoicesMigration_103 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Invoices', [
                'columns' => [
                    new Column(
                        'id',
                        [
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 10,
                            'first' => true
                        ]
                    ),
                    new Column(
                        'customer_id',
                        [
                            'type'     => Column::TYPE_INTEGER,
                            'size'     => 10,
                            'unsigned' => true,
                            'notNull'  => true,
                        ]
                    ),

                    new Column(
                        'description',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 200,
                        ]
                    ),

                    new Column(
                        'date_created',
                        [
                            'type' => Column::TYPE_DATE,
                            'notNull' => true,
                        ]
                    ),

                    new Column(
                        'amount',
                        [
                            'type' => Column::TYPE_DECIMAL,
                            'notNull' => true,
                            'size' => 65,
                        ]
                    )


                ],
                'indexes' => [
                    new Index('PRIMARY', ['id'], 'PRIMARY'),
                    new Index(
                        'customer_id',
                        [
                            'customer_id',
                        ]
                    ),
                ],

                'references' => [
                    new Reference(
                        'invoices_ibfk_1',
                        [
                            'referencedSchema'  => 'customer_control',
                            'referencedTable'   => 'customers',
                            'columns'           => ['customer_id'],
                            'referencedColumns' => ['id'],
                        ]
                    ),
                ],

                'options' => [
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'MyISAM',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ],
            ]
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

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
