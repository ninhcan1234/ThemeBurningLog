<?php

namespace AHT\UiComponent\Controller\Adminhtml\Attrcustomer;

use Exception;
use Magento\Customer\Model\ResourceModel\Attribute;
use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Backend\App\Action;
use Magento\Customer\Model\ResourceModel\Customer as CustomerResource;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;

/**
 * Product attribute save controller.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends Action
{
    protected $attributeResource;

    protected $eavSetupFactory;

    protected $eavConfig;

    protected $moduleDataSetup;

    protected $customerResource;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        Config $eavConfig,
        Action\Context $context,
        CustomerResource $customerResource
    ) {

        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavConfig = $eavConfig;
        $this->customerResource = $customerResource;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $attributeCode = $data['attribute_code'];
        $source = '';

        if ($data['input'] == 'select' || $data['input'] == 'boolean') {
            $source = 'Magento\Eav\Model\Entity\Attribute\Source\Boolean';
        }

        if ($data) {
            try {
                $this->moduleDataSetup->getConnection()->startSetup();
                /** @var EavSetup $eavSetup */
                $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

                $eavSetup->addAttribute(Customer::ENTITY, $attributeCode, [
                    'label' => $data['label'],
                    'type' => $data['type'],
                    'input' => $data['input'],
                    'required' => $data['required'],
                    'visible' => $data['visible'],
                    'system' => $data['system'],
                    'source' => $source,
                    'position' => $data['sort_order'],
                ]);

                $customerAttribute = $this->eavConfig->getAttribute(Customer::ENTITY, $attributeCode);
                foreach ($data['used_in_forms'] as $used ) {
                    $customerAttribute->setData(['used_in_forms', $used]);
                }

                $this->customerResource->save($customerAttribute);
                $this->moduleDataSetup->getConnection()->endSetup();
                $this->messageManager->addSuccessMessage(__('Added Attribute') . $data['label'] . __(' Susccessfully!'));
            } catch (Exception $e) {
                $this->messageManager->addErrorMessage(__('Has been error while save attribute!'));
            }
        }
        $resulrRedirect = $this->resultRedirectFactory->create();
        return $resulrRedirect->setPath('*/*/');
    }
}
