<?php
namespace AHT\Banner\Block\Adminhtml\Banner\Edit;

class ResetButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label'=> __('Reset'),
            'class'=> 'reset',
            'on_click'=>'location.reload();',
            'sort_order'=>30
        ];
    }
}
