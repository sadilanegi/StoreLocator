<?php
namespace Iksula\Storelocator\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), '1.0.1') < 0){
    		 $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'view360',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'view360'
            ]

        );

		}

        if (version_compare($context->getVersion(), '1.0.2', '<')){
            $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'storeopentime',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'=> 255,
                'nullable' => true,
                'comment' => 'storeopentime'
            ]

        );

            $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'storeclosetime',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'=> 255,
                'nullable' => true,
                'comment' => 'storeclosetime'
            ]

        );

        }

        if (version_compare($context->getVersion(), '1.0.3', '<')){
            $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'iframe360',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'iframe360'
            ]

        );
        }
         if (version_compare($context->getVersion(), '1.0.4', '<')){
            $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'mapiframe',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'mapiframe'
            ]

        );
        }
        if (version_compare($context->getVersion(), '1.0.5', '<')){
            $installer->getConnection()->addColumn(
            $installer->getTable('store_location'),
            'mapshareurl',
            [
                'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'nullable' => true,
                'comment' => 'mapshareurl'
            ]

        );
        }

        $installer->endSetup();
    }
}