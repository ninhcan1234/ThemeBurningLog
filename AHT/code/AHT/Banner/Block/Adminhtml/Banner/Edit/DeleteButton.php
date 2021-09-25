<?php
namespace AHT\Banner\Block\Adminhtml\Banner\Edit;

class DeleteButton extends GenericButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function getButtonData(){
        $data = [];
        if($this->getPostId()){
            $data = [
            'label' => __('Delete'),
            'class'=> 'delete',
            'on_click'=> 'deleteConfirm(\'' . __(
                'Are you sure to delete?'
                ). '\', \''. $this->getDeleteUrl(). '\')',
            'sort_order'=> 20
            ];
        }
        return $data;
       
    }

    public function getDeleteUrl(){
        
    }
}
