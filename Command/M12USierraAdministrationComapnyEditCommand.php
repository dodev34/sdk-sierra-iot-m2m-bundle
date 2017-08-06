<?php

namespace M12U\Bundle\Sdk\Sierra\IotM2MBundle\Command;

use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Administration\Company;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Client\Exception\ClientException;
use M12U\Bundle\Sdk\Sierra\IotM2MBundle\Provider\ProxyProvider;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class M12USierraAdministrationComapnyDetailsCommand
 * @package M12U\Bundle\Sdk\Sierra\IotM2MBundle\Command
 */
class M12USierraAdministrationComapnyDetailsCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('m12u:sierra:admin:company:edit')
            ->setDescription('
                    Edit details of a company. Only name, address, ipFiltering, ipFilters, 
                    deviceIpFiltering and deviceIpFilters fields can be updated.'
            )
            ->addOption(
                'uid',
                null,
                InputOption::VALUE_REQUIRED,
                'Company uid',
                null
            )
            ->addOption(
                'name',
                null,
                InputOption::VALUE_REQUIRED,
                'Company name',
                null
            )
            ->addOption(
                'address',
                null,
                InputOption::VALUE_REQUIRED,
                'Company address',
                null
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ProxyProvider $service */
        $service = $this->getContainer()->get('m12u.sdk.sierra.iot_m2m.provider_proxy');
        $name = $input->getOption('name');
        $address = $input->getOption('address');

        try {
            /** @var Company $system */
            $company = $service->getClient('admin.company');
            $reponse = $company->edit(['name'=> $name, 'address' => $address]);
            $reponse = json_decode($reponse);
            $output->writeln(sprintf("Response '%s'", $reponse->name));
        } catch (ClientException $e) {
            $output->writeln('<error>'.$e->getCode().':'.$e->getMessage().'</error>');
        }
    }
}
