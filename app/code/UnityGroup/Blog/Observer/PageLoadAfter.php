<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Observer;

use Magento\Cms\Api\Data\PageInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use UnityGroup\Blog\Api\PostRepositoryInterface;
use UnityGroup\Blog\Model\ResourceModel\PostResource;

class PageLoadAfter implements ObserverInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private PostRepositoryInterface $postRepository;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param PostRepositoryInterface $postRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        LoggerInterface $logger
    )
    {
        $this->postRepository = $postRepository;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return PageInterface
     */
    public function execute(Observer $observer): PageInterface
    {
        $page = $observer->getEvent()->getData()['object'];

        $post = $this->postRepository->getByPageId((int) $page->getData('page_id'));

        if (false === $post->isObjectNew()) {
            $page->setData(PostResource::FIELD_AUTHOR_FULL_NAME, $post->getAuthorFullName());
            $page->setData(PostResource::FIELD_IS_BLOG_POST, $post->getIsBlogPost());
            $page->setData(PostResource::FIELD_PUBLISHED_AT, $post->getPublishedAt());
        }

        return $page;
    }
}
