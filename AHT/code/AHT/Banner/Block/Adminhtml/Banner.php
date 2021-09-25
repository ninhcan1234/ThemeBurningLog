<?php
namespace AHT\Banner\Block\Adminhtml;

class Banner extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
       $this->_controller = 'adminhtml_banner';
       $this->_blockGroup = 'AHT_Banner';
       $this->_headerText = __('Manage Banner');

       parent::_construct();

       if($this->_isAllowedAction('AHT_Banner::save')){
           $this->buttonList->update('add', 'label', __('Add Banner'));
       }else{
           $this->buttonList->remove('add');
       }
    }

    public function isAllowedAction($id){
        return $this->_authorization->isAllowed($id);
    }
}
