<?php

namespace UnityGroup\Blog\Api;

use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Model\ResourceModel\Post as PostResource;

interface PostManagementInterface
{
    /**
     * @return PostInterface
     */
    public function getEmptyObject(): PostInterface;

    /**
     * @param PostInterface $post
     * @return PostResource
     * @throws \Exception
     */
    public function save(PostInterface $post): PostResource;
}
