<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Controller\Index;

use Psr\Log\LoggerInterface;

class Insert extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    protected $_postFactory;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \UnityGroup\Blog\Model\PostFactory $postFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_postFactory = $postFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->_postFactory->create();

        exit();
    }
}
