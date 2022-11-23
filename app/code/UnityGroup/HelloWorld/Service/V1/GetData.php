<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Service\V1;

class GetData implements GetDataInterface
{
    private string $format = 'Y-m-d H:i:s';

    /**
     * @inheritDoc
     */
    public function dataForApiCall(): string {
        return $this->collectData();
    }

    /**
     * @inheritDoc
     */
    public function getRawData(): string {
        return $this->collectData();
    }

    /**
     * @param string $format
     * @return void
     */
    public function setFormat(string $format): void {
        $this->format = $format;
    }

    /**
     * @return string
     */
    protected function collectData(): string
    {
        return 'Hello World ' . date($this->format);
    }
}
