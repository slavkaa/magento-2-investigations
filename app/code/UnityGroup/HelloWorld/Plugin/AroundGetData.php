<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Plugin;
use Psr\Log\LoggerInterface;
use UnityGroup\HelloWorld\Service\V1\GetData;

class AroundGetData
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function aroundDataForApiCall(GetData $class, callable $proceed)
    {
        $this->logger->debug('aroundDataForApiCall called.');
        return $proceed() . ' -around';
    }
}
