<?php
namespace AHT\Banner\Controller\Adminhtml\Index;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'AHT_UiComponent::banner_menu';
    const PAGE_TITLE = 'Banner';
       /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        // $resultPage->addBreadcrumb(__('Dashboard'), __('Dashboard'));
        $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));

        return $resultPage;
    }
}
