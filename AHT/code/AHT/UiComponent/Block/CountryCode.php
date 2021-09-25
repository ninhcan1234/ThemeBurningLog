<?php
namespace AHT\UiComponent\Block\Frontend;

class CountryCode extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    protected $countryFactory ;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Directory\Model\CountryFactory $countryFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->countryFactory = $countryFactory;
    }

    public function getCountryName($code){
        $country = $this->countryFactory->create()->loadByCode($code);
        return $country->getName();
    }
}
