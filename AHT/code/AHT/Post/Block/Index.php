<?php
namespace AHT\Post\Block;

class Index extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    protected $_allPost;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Post\Model\ResourceModel\Post\Collection $allPost,
        array $data = []
    ) {
        $this->_allPost = $allPost;
        parent::__construct($context, $data);
    }

    public function getAll(){
        $data = $this->_allPost;
        return $data;
    }

    public function toSave(){
        return $this->getUrl('post/action/save');
    }

    public function toEdit($id){
        return $this->getUrl('post/action/edit?id='.$id);
    }

    public function toDelete($id){
        return $this->getUrl('post/action/delete?id='.$id);
    }
}
