<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Model\Resolver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ValueFactory;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use UnityGroup\HelloWorld\Service\V1\GetDataInterface;

class Data implements ResolverInterface
{
    public function __construct(
        ValueFactory $valueFactory,
        GetDataInterface $getDataService
    ) {
        $this->valueFactory = $valueFactory;
        $this->getDataService = $getDataService;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)  {

        if (!isset($args['format'])) {
            throw new GraphQlAuthorizationException(
                __(
                    'title should be specified in query',
                    'data'
                )
            );
        }
        try {
            $this->getDataService->setFormat($args['format']);
            $data = $this->getDataService->getDataForGraphQlCall();

            return $this->valueFactory->create(
                function () use ($data) {
                    return $data;
                }
            );
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }
    }
}
