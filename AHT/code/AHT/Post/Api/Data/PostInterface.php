<?php
namespace AHT\Post\Api\Data;

interface PostInterface 
{
    const ID = 'post_id';
    const NAME = 'name';
    const DESCRIPTION = 'description';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const STATUS = 'status';

    public function getId();

    public function setId($id);

    public function getName();

    public function setName($name);

    public function getDescription();

    public function setDescription($description);

    public function getCreatedAt();

    public function setCreatedAt($createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt($updatedAt);

    public function getStatus();
    
    public function setStatus($status);
  

}
