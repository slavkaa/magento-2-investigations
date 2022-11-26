<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Service;

use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Api\PostManagementInterface;
use UnityGroup\Blog\Model\ResourceModel\PostResource as PostResource;
use UnityGroup\Blog\Model\PostFactory;

class PostManagement implements PostManagementInterface
{
    /**
     * @var PostFactory
     */
    private PostFactory $postFactory;

    /**
     * @var PostResource
     */
    private PostResource $postResource;

    /**
     * @param PostFactory $postFactory
     * @param PostInterface $postResource
     */
    public function __construct(
        \UnityGroup\Blog\Model\PostFactory $postFactory,
        PostResource $postResource
    )
    {
        $this->postFactory = $postFactory;
        $this->postResource = $postResource;
    }

    /**
     * @inheritDoc
     */
    public function getEmptyObject(): PostInterface
    {
        return $this->postFactory->create();
    }

    /**
     * @inheritDoc
     */
    public function save(PostInterface $post): PostResource
    {
        return $this->postResource->save($post);
    }
}
