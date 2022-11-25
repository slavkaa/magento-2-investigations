<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Model;

use Magento\Framework\Model\AbstractModel;
use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Model\ResourceModel\Post as PostResource;

class Post extends AbstractModel implements PostInterface
{
    protected function _construct()
    {
        parent::_construct();

        $this->_init(PostResource::class);
    }
}
