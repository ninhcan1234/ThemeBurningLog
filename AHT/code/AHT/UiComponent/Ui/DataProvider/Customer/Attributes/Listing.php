<?php
namespace AHT\UiComponent\Ui\DataProvider\Customer\Attributes;

use Magento\Catalog\Model\AttributeHandler;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\ResourceModel\Attribute\CollectionFactory;

/**
 * DataProvider for customer attributes listing
 */
class Listing extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->request = $request;
        $this->collection = $collectionFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $this->collection->setExcludeSetFilter((int)$this->request->getParam('template_id', 0));
        $this->collection->getSelect()->setPart('order', []);

        $items = [];
        foreach ($this->getCollection()->getItems() as $attribute) {
            $items[] = $attribute->toArray();
        }

        return [
            'totalRecords' => $this->collection->getSize(),
            'items' => $items
        ];
    }
}
