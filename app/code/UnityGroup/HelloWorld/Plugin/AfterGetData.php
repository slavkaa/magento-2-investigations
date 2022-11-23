<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Plugin;
use Psr\Log\LoggerInterface;
use UnityGroup\HelloWorld\Service\V1\GetData;

class AfterGetData
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function afterDataForApiCall(GetData $class, string $result): string
    {
        $this->logger->debug('afterDataForApiCall called.');

        return $result . ' -after';
    }
}
