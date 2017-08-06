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
class M12USierraOperationSystemDeleteCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('m12u:sierra:operation:system:delete')
            ->setDescription('
                  Delete a specific system from AirVantage. 
                  If needed, the user can delete the gateway and the subscription linked to the system.'
            )
            ->addOption(
                'uid',
                'u',
                InputOption::VALUE_REQUIRED,
                'uid of system',
                null
            )
            ->addOption(
                'delete-gateway',
                'dg',
                InputOption::VALUE_OPTIONAL,
                'If true, the gateway linked to the system is also deletedm',
                null
            )
            ->addOption(
                'delete-subscription',
                'ds',
                InputOption::VALUE_OPTIONAL,
                'If true, the subscription linked to the system are also deleted',
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
        $uid = (string)$input->getOption('uid');

        $query = [];
        if($deleteGateway = $input->getOption('delete-gateway')) {
            $query['deleteGateway'] = $deleteGateway;
        }
        if ($deleteSubscription = $input->getOption('delete-subscription')) {
            $query['deleteSubscription'] = $deleteSubscription;
        }

        try {
            /** @var System $system */
            $system = $service->getClient('operations.system.system');
            $system->delete($uid, $query);
            $output->writeln('UID delete >> <info>'.$uid.'</info>');
        } catch (ClientException $e) {
            $output->writeln('<error>'.$e->getCode().':'.$e->getMessage().'</error>');
        }
    }
}
