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
     * @return string
     */
    public function getRawData(): string;
}
