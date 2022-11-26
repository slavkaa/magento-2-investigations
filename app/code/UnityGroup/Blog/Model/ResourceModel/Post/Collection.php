<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use UnityGroup\Blog\Model\Post;
use UnityGroup\Blog\Model\ResourceModel\PostResource as PostResource;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Post::class, PostResource::class);
    }
}
