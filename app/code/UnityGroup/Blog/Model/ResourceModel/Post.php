<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
         $this->_init('unitygroup_blog_cms_page', 'post_id');
    }
}
