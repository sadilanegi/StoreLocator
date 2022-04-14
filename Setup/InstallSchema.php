<?php
namespace Iksula\Storelocator\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0){
    		$installer->run('
                create table if not exists store_location(
                    id int not null auto_increment,
                    name varchar(255) not null,
                    address text not null,
                    area varchar(255) null,
                    city varchar(255),
                    state varchar(100),
                    phone varchar(255),
                    email varchar(255),
                    pincode varchar(255) not null,
                    lattitude varchar(255) not null,
                    longitude varchar(255) not null,
                    landmark varchar(255),
                    status varchar(255) not null,
                    image varchar(100),
                    primary key(id)
                )
            ');

		}
        $installer->endSetup();
    }
}