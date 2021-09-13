<?php
namespace AHT\Post\Model\Post;

use AHT\Post\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use AHT\Post\Model\Post;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\AuthorizationInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \AHT\Post\Model\ResourceModel\Post\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var AuthorizationInterface
     */
    private $auth;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CustomLayoutManagerInterface
     */
    private $customLayoutManager;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     * @param AuthorizationInterface|null $auth
     * @param RequestInterface|null $request
     * @param CustomLayoutManagerInterface|null $customLayoutManager
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null,
        ?AuthorizationInterface $auth = null,
        ?RequestInterface $request = null
    ) {
        $this->collection = $postCollectionFactory->create();
        $this->collectionFactory = $postCollectionFactory;
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->auth = $auth ?? ObjectManager::getInstance()->get(AuthorizationInterface::class);
        $this->meta = $this->prepareMeta($this->meta);
        $this->request = $request ?? ObjectManager::getInstance()->get(RequestInterface::class);
    }

    /**
     * Find requested post.
     *
     * @return Post|null
     */
    private function findCurrentPost(): ?Post
    {
        if ($this->getRequestFieldName() && ($postId = (int)$this->request->getParam($this->getRequestFieldName()))) {
            //Loading data for the collection.
            $this->getData();
            return $this->collection->getItemById($postId);
        }

        return null;
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->collection = $this->collectionFactory->create();
        $items = $this->collection->getItems();
        /** @var $post \AHT\Post\Model\Post */
        foreach ($items as $post) {
            $this->loadedData[$post->getId()] = $post->getData();
            if ($post->getCustomLayoutUpdateXml() || $post->getLayoutUpdateXml()) {
                //Deprecated layout update exists.
                $this->loadedData[$post->getId()]['layout_update_selected'] = '_existing_';
            }
        }

        $data = $this->dataPersistor->get('post');
        if (!empty($data)) {
            $post = $this->collection->getNewEmptyItem();
            $post->setData($data);
            $this->loadedData[$post->getId()] = $post->getData();
            if ($post->getCustomLayoutUpdateXml() || $post->getLayoutUpdateXml()) {
                $this->loadedData[$post->getId()]['layout_update_selected'] = '_existing_';
            }
            $this->dataPersistor->clear('post');
        }

        return $this->loadedData;
    }

    /**
     * @inheritDoc
     */

}
