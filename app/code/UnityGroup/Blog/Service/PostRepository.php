<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Service;

use Magento\Cms\Api\Data\PageSearchResultsInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Api\PostManagementInterface;
use UnityGroup\Blog\Api\PostRepositoryInterface;
use UnityGroup\Blog\Model\ResourceModel\PostResource as PostResource;

class PostRepository implements PostRepositoryInterface
{
    private PageRepositoryInterface $pageRepository;

    private SearchCriteriaBuilder $searchCriteriaBuilder;

    private PostResource $resourceModel;

    private PostManagementInterface $postManagement;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostResource $resourceModel,
        PostManagementInterface $postManagement
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resourceModel = $resourceModel;
        $this->postManagement = $postManagement;
    }

    public function get(): PageSearchResultsInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->pageRepository->getList($searchCriteria);
    }

    /**
     * @inheritDoc
     */
    public function getByPageId(int $pageId): PostInterface
    {
        $post = $this->postManagement->getEmptyObject();
        $this->resourceModel->load($post, $pageId, 'page_id');

        return $post;
    }
}
