<?php
namespace AHT\Post\Api;
use AHT\Post\Api\Data\PostInterface;

interface PostRepositoryInterface
{
   public function load(PostInterface $postInterface, $value , $field = null);

   public function save(PostInterface $postInterface);

   public function delete(PostInterface $postInterface);

   public function getById($id);

   public function deleteById($id);
}
