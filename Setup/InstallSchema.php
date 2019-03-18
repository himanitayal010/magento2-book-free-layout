<?php
namespace Magneto\BookLayout\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
		$installer = $setup;
		$installer->startSetup();

		/**
		 * Creating table magneto_booklayout
		 */
		$table = $installer->getConnection()->newTable(
			$installer->getTable('magneto_booklayout')
		)->addColumn(
			'booklayout_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			null,
			['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
			'Entity Id'
		)->addColumn(
			'name',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true],
			'Name'
		)->addColumn(
			'email',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Email'
		)->addColumn(
			'mobile_number',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			1,
			['nullable' => false,'default' => 0],
			'Phone Number'
		)->addColumn(
			'height',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'Height'
		)->addColumn(
			'width',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			'2M',
			['nullable' => true,'default' => null],
			'Width'
		)->addColumn(
			'image',
			\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
			255,
			['nullable' => true,'default' => null],
			'Image'
		)->addColumn(
			'product_id',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			'10',
			['nullable' => true,'default' => null],
			'Product Entity Id'
		)->addColumn(
			'status',
			\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
			'null',
			['nullable' => false,'default' => 0],
			'Status'
		)->addColumn(
			'created_at',
			\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
			null,
			['nullable' => false],
			'Created At'
		)->setComment(
            'Magneto Book A Free 3D Layout Table'
        );
        
		$installer->getConnection()->createTable($table);
		$installer->endSetup();
	}
}