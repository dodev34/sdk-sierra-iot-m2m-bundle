<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Command;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Exception\ClientException;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Operations\System\System;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ProxyProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class M12USierraCommand
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Command
 */
class M12USierraOperationSystemCreateCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('m12u:sierra:operation:system:create')
            ->setDescription('
                Create a single system from scratch.
                For the associated gateway and the subscription,
                you can either create a new one on the fly or select an existing one by its uid.'
            )
            ->addOption(
                'name',
                null,
                InputOption::VALUE_REQUIRED,
                'system name',
                null
            )
            ->addOption(
                'company',
                'c',
                InputOption::VALUE_OPTIONAL,
                'Company UID',
                null
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProxyProvider $service */
        $service = $this->getContainer()->get('m12u.sdk.sierra.iot_m2m.provider_proxy');
        $name = $input->getOption('name');

        $query = [];
        if ($company = $input->getOption('company')) {
            $query['company'] = $company;
        }

        try {
            /** @var System $system */
            $system = $service->getClient('operations.system.system');
            $reponse = $system->create(['name' => $name], $query);
            $reponse = json_decode($reponse);
            $output->writeln('System <info>'.$name.'</info> create with uid : >> <info>'.$reponse->uid.'</info>');
        } catch (ClientException $e) {
            $output->writeln('<error>'.$e->getCode().':'.$e->getMessage().'</error>');
        }
    }
}
