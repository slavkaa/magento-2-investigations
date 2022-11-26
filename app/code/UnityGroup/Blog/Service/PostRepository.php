<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Service;

use Magento\Cms\Api\Data\PageSearchResultsInterface;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Api\PostManagementInterface;
use UnityGroup\Blog\Api\PostRepositoryInterface;
use UnityGroup\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use UnityGroup\Blog\Model\ResourceModel\PostResource;

class PostRepository implements PostRepositoryInterface
{
    private PageRepositoryInterface $pageRepository;

    private SearchCriteriaBuilder $searchCriteriaBuilder;

    private PostResource $resourceModel;

    private PostManagementInterface $postManagement;

    private PostCollectionFactory $postCollectionFactory;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        PostResource $resourceModel,
        PostManagementInterface $postManagement,
        PostCollectionFactory $postCollectionFactory
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->resourceModel = $resourceModel;
        $this->postManagement = $postManagement;
        $this->postCollectionFactory = $postCollectionFactory;
    }

    public function get(): PageSearchResultsInterface
    {
        $postCollection = $this->postCollectionFactory->create();
        $postCollection->addFieldToFilter(
            PostResource::FIELD_IS_BLOG_POST,
            ['eq' => 1]
        );

        $pageIds = [];

        foreach ($postCollection->getItems() as $item) {
            $pageIds[] = $item->getPageId();
        }

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(PostResource::FIELD_PAGE_ID, $pageIds, 'in')
            ->create();

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
