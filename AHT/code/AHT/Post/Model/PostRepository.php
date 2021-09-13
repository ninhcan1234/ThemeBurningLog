<?php
namespace AHT\Post\Model;
use \AHT\Post\Api\Data\PostInterface;

class PostRepository implements \AHT\Post\Api\PostRepositoryInterface{

    protected $_postResourceModel;
    protected $_postFactory;

    public function __construct(
        \AHT\Post\Model\PostFactory $postFactory,
        \AHT\Post\Model\ResourceModel\Post $postResource
    )
    {
        $this->_postFactory = $postFactory;
        $this->_postResourceModel = $postResource;
    }

    public function load(PostInterface $post, $value, $field= null){
        $this->_postResourceModel->load($post, $value, $field = null);
        return $post;
    }

    public function save(PostInterface $post){
        $this->_postResourceModel->save($post);
        return $post;
    }

    public function delete(PostInterface $post){
        $this->_postResourceModel->delete($post);
        return true;
    }

    public function getById($id){
        $post = $this->_postFactory->create();
        $this->_postResourceModel->load($post, $id);
        return $post;
    }

    public function deleteById($id){
        $post = $this->_postFactory->create();
        $this->_postResourceModel->load($post, $id);
        $this->_postResourceModel->delete($post);
        return true;
    }

  
}
