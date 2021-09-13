<?php
namespace AHT\UiComponent\Controller\Adminhtml\Posting;

use Magento\Framework\App\Request\DataPersistorInterface;
use Exception;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action;
use Magento\Cms\Model\Page;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save CMS page action.
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */

    /**
     * @var PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Magento\Cms\Model\PostFactory
     */
    private $postFactory;

    /**
     * @var \Magento\Cms\Api\PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @param Action\Context $context
     * @param PostDataProcessor $dataProcessor
     * @param DataPersistorInterface $dataPersistor
     * @param \Magento\Cms\Model\PageFactory|null $pageFactory
     * @param \Magento\Cms\Api\PageRepositoryInterface|null $pageRepository
     */
    public function __construct(
        Action\Context $context,
        // PostDataProcessor $dataProcessor,
        DataPersistorInterface $dataPersistor,
        \AHT\Post\Model\PostFactory $postFactory ,
        \AHT\Post\Api\PostRepositoryInterface $postRepository 
    ) {
        // $this->dataProcessor = $dataProcessor;
        $this->dataPersistor = $dataPersistor;
        $this->postFactory = $postFactory ;
        $this->postRepository = $postRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $date = date('d-m-Y H:i:s');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $data = $this->dataProcessor->filter($data);
            // if (isset($data['status']) && $data['status'] === 'true') {
            //     $data['status'] = Page::STATUS_ENABLED;
            // }
            if (empty($data['post_id'])) {
                $data['post_id'] = null;
                $data['created_at'] = $date;
            }

            /** @var \Magento\Cms\Model\Page $model */
            $model = $this->postFactory->create();

            $id = $this->getRequest()->getParam('post_id');
            if ($id) {
                try {
                    $model = $this->postRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This post no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->postRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the post.'));
                return $this->processResultRedirect($model, $resultRedirect, $data);
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Throwable $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the post.'));
            }

            $this->dataPersistor->set('post', $data);
            return $resultRedirect->setPath('*/*/edit', ['post_id' => $this->getRequest()->getParam('post_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process result redirect
     *
     * @param \Magento\Cms\Api\Data\PageInterface $model
     * @param \Magento\Backend\Model\View\Result\Redirect $resultRedirect
     * @param array $data
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws LocalizedException
     */
    private function processResultRedirect($model, $resultRedirect, $data)
    {
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            $newPost = $this->postFactory->create(['data' => $data]);
            $newPost->setId(null);
            $identifier = $model->getIdentifier() . '-' . uniqid();
            $newPost->setIdentifier($identifier);
            $newPost->setIsActive(false);
            $this->postRepository->save($newPost);
            $this->messageManager->addSuccessMessage(__('You duplicated the post.'));
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'post_id' => $newPost->getId(),
                    '_current' => true
                ]
            );
        }
        $this->dataPersistor->clear('cms_post');
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['page_id' => $model->getId(), '_current' => true]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
