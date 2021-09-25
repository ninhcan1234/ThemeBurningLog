<?php

namespace AHT\UiComponent\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;

class ActionAttribute extends Column
{
    /** Url path */
    const URL_PATH_EDIT = 'uic/attrcustomer/edit';
    const URL_PATH_DELETE = 'uic/attrcustomer/delete';
    /** @var UrlInterface */
    protected $_urlBuilder;

    /**
     * @var string
     */
    private $_editUrl;

    private $_deleteUrl;

    protected $eavSetupFactory;

    protected $moduleDataSetup;

    /**
     * @param ContextInterface   $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface       $urlBuilder
     * @param array              $components
     * @param array              $data
     * @param string             $editUrl
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::URL_PATH_EDIT,
        $deleteUrl = self::URL_PATH_DELETE
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        $this->_deleteUrl = $deleteUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $attribute_code = $this->getData('attribute_code');
                $name = $this->getData('name');
                if (isset($item['attribute_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl,
                            ['attribute_code' => $item['attribute_code']]
                        ),
                        'label' => __('Edit'),
                    ];
                    $this->moduleDataSetup->getConnection()->startSetup();
                    $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
                    $item[$name]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_deleteUrl,
                            ['attribute_code' => $item['attribute_code']]
                        ),
                        'label' => __('Delete'),
                        'confirm' => [
                            'name' => __('Delete %1', $name),
                            'message' => __('Are you sure you want to delete a %1 record?', $name),
                        ],
                        'post' => true,
                        // $eavSetup->removeAttribute(Customer::ENTITY,$item['attribute_code']),
                        '__disableTmpl' => true,
                    ];
                    $this->moduleDataSetup->getConnection()->endSetup();
                }
            }
        }

        return $dataSource;
    }
}
