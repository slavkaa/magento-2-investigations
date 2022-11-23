<?php
declare(strict_types=1);

namespace UnityGroup\HelloWorld\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnityGroup\HelloWorld\Service\V1\GetDataInterface;

class GetDataCommand extends Command
{
    /**
     * @var GetDataInterface
     */
    protected GetDataInterface $helloWorldService;

    /**
     * DomainsAddCommand constructor.
     * @param GetDataInterface $helloWorldService
     */
    public function __construct(
        \UnityGroup\HelloWorld\Service\V1\GetDataInterface $helloWorldService
    ) {
        $this->helloWorldService = $helloWorldService;
        parent::__construct();
    }

    protected function configure()
    {
        parent::configure();

        $this->setName('hello-world:data:get');

        $this->setDescription('Return data for Hello world module.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write(
            $this->helloWorldService->getRawData()
        );
    }
}
