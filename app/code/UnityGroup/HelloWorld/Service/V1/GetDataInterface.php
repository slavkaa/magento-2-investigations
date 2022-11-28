<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Service\V1;

interface GetDataInterface
{
    /**
     * @return string
     */
    public function dataForApiCall(): string;

    /**
     * @return array
     */
    public function getDataForGraphQlCall(): array;

    /**
     * @return string
     */
    public function getRawData(): string;

    /**
     * @param string $format
     * @return void
     */
    public function setFormat(string $format): void;
}
