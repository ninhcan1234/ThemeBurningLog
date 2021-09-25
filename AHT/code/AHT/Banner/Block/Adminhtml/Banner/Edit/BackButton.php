<?php
namespace AHT\Banner\Block\Adminhtml\Banner\Edit;

class BackButton extends GenericButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function getButtonData(){
        return [
            'label' => __('Back'),
            'on_click'=> sprintf("location.href = '%s';", $this->getBackUrl()),
            'class'=> 'back',
            'sort_order'=> 10
        ];
    }

    public function getBackUrl(){
        
    }
}
