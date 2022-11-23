<?php

namespace UnityGroup\HelloWorld\Test\Api;

use JetBrains\PhpStorm\NoReturn;
use Magento\Framework\Webapi\Request;

class GetDataTest extends \Magento\TestFramework\TestCase\WebapiAbstract
{
    /**
     * @return void
     */
    #[NoReturn] public function testGetData(): void
    {
        $serviceInfo = [
            'rest' => [
                'resourcePath' => '/V1/hello-world/get-data',
                'httpMethod' => Request::METHOD_GET
            ]
        ];

        $response = $this->_webApiCall($serviceInfo);

        $this->assertTrue(substr_count($response, 'Hello World') === 1);
    }
}
