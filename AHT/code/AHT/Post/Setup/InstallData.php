<?php
namespace AHT\Post\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_postFactory;

    public function __construct(\AHT\Post\Model\PostFactory $postFactory)
    {
        $this->_postFactory = $postFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $data = [
            'name'=>'name1',
            'description'=>'abcccc',
            'created_at'=>date("d-m-Y H:i:s"),
            'status'=>1
        ];
        $post = $this->_postFactory->create();
        $post->addData($data)->save();

        $setup->endSetup();
    }
}