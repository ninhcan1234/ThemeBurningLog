<?php
namespace AHT\Banner\Block\Adminhtml\Banner\Edit;

class SaveAndContinueButton extends GenericButton implements \Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label'=>__('Save and continue Edit'),
            'class'=>'save',
            'data_attribute'=>[
                'mage-init'=>[
                    'button'=>['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order'=> 80,
        ];
    }
}
