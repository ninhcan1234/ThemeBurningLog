<?php
namespace AHT\Banner\Block\Adminhtml\Banner\Edit;
use Magento\Backend\Block\Widget\Context;
use AHT\Post\Api\PostRepositoryInterface;

class GenericButton 
{
    protected $context;

    protected $postRepositoryInterface;

    public function __construct(
        Context $context,
        PostRepositoryInterface $postRepositoryInterface
    )
    {
        $this->context = $context;
        $this->postRepositoryInterface = $postRepositoryInterface;
    }

    public function getPostId(){
        return $this->postRepositoryInterface->getById(
            $this->context->getRequest()->getParam('post_id')
        )->getId();

    }

    public function getUrl($routes = '', $params = []){
        return $this->context->getUrlBuilder()->getUrl($routes, $params);
    }
}
