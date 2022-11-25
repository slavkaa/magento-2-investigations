<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use UnityGroup\Blog\Api\Data\PostInterface;
use UnityGroup\Blog\Api\PostManagementInterface;
use UnityGroup\Blog\Model\Post;

class PageSaveAfter implements ObserverInterface
{
    /**
     * @var PostManagementInterface
     */
    private PostManagementInterface $postManagement;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param PostManagementInterface $postManagement
     * @param LoggerInterface $logger
     */
    public function __construct(
        PostManagementInterface $postManagement,
        LoggerInterface $logger
    )
    {
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
        $this->logger->debug('execute');

        /** @var \Magento\Cms\Model\Page $data */
        $data = $observer->getEvent()->getData()['data_object']->getData();

        /** @var PostInterface|Post $post */
        $post = $this->postManagement->getEmptyObject();
        $post->setData('page_id', (int) $data['page_id']);
        $post->setData('author_full_name', $data['author_full_name']);
        $post->setData('is_blog_post', (boolean) $data['is_blog_post']);
        $post->setData('published_at',  str_replace(['.000Z'], '', str_replace('T', ' ', $data['published_at'])));

        $this->postManagement->save($post);
    }
}
