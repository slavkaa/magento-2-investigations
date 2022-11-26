<?php
declare(strict_types=1);

namespace UnityGroup\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PostResource extends AbstractDb
{
    /** @var string  */
    public const FIELD_PAGE_ID = 'page_id';

    /** @var string  */
    public const FIELD_AUTHOR_FULL_NAME = 'author_full_name';

    /** @var string  */
    public const FIELD_IS_BLOG_POST = 'is_blog_post';

    /** @var string  */
    public const FIELD_PUBLISHED_AT = 'published_at';

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
