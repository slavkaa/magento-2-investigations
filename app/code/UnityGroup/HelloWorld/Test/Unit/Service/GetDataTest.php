<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Test\Unit\Service;

use PHPUnit\Framework\TestCase;
use UnityGroup\HelloWorld\Service\V1\GetData;

class GetDataTest extends TestCase
{
    /**
     * @var GetData
     */
    protected GetData $getDataService;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->getDataService = new GetData();
    }

    /**
     * @return void
     */
    public function testGetData(): void
    {
        $result = $this->getDataService->getRawData();

        $this->assertTrue(substr_count($result, 'Hello World') === 1);
    }
}
