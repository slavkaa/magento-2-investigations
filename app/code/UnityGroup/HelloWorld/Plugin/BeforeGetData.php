<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Plugin;
use Psr\Log\LoggerInterface;
use UnityGroup\HelloWorld\Service\V1\GetData;

class BeforeGetData
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return string
     */
    public function beforeDataForApiCall(GetData $class)
    {
        $class->setFormat('Y-Y-Y');
        $this->logger->debug('beforeDataForApiCall called.');
    }
}
