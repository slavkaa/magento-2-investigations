<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Api\PostManagementInterface;
use UnityGroup\Blog\Api\PostRepositoryInterface;
use UnityGroup\Blog\Model\Post;
use UnityGroup\Blog\Model\ResourceModel\PostResource;

class PageSaveAfter implements ObserverInterface
{
    /**
     * @var PostManagementInterface
     */
    private PostManagementInterface $postManagement;

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
     * @param PostManagementInterface $postManagement
     * @param LoggerInterface $logger
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        PostManagementInterface $postManagement,
        LoggerInterface $logger
    )
    {
        $this->postRepository = $postRepository;
        $this->postManagement = $postManagement;
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws \Exception
     */
    public function execute(Observer $observer): void
    {
        /** @var \Magento\Cms\Model\Page $data */
        $data = $observer->getEvent()->getData()['data_object']->getData();

        /** @var PostInterface|Post $post */
        $post = $this->postRepository->getByPageId((int)$data[PostResource::FIELD_PAGE_ID]);

        $post->setData(PostResource::FIELD_PAGE_ID, (int) $data[PostResource::FIELD_PAGE_ID]);
        $post->setData(PostResource::FIELD_AUTHOR_FULL_NAME, $data[PostResource::FIELD_AUTHOR_FULL_NAME]);
        $post->setData(PostResource::FIELD_IS_BLOG_POST, (boolean) $data[PostResource::FIELD_IS_BLOG_POST]);
        $post->setData(
            PostResource::FIELD_PUBLISHED_AT,
            str_replace(['.000Z'], '', str_replace('T', ' ', $data[PostResource::FIELD_PUBLISHED_AT]))
        );

        $this->postManagement->save($post);
    }
}
