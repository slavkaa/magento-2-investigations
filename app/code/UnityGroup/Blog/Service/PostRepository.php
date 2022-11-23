<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Service;

use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

class PostRepository
{
    /**
     * @var PageRepositoryInterface
     */
    private PageRepositoryInterface $pageRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        PageRepositoryInterface $pageRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->pageRepository = $pageRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    public function get()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        return $this->pageRepository->getList($searchCriteria);
    }
}
