<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Api;

use Magento\Cms\Api\Data\PageSearchResultsInterface;
use UnityGroup\Blog\Api\Data\PostInterface;

interface PostRepositoryInterface
{
    /**
     * @return PageSearchResultsInterface
     */
    public function get(): PageSearchResultsInterface;

    /**
     * @param int $pageId
     * @return PostInterface
     */
    public function getByPageId(int $pageId): PostInterface;
}
