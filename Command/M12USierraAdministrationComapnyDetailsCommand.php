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
            ->setName('m12u:sierra:admin:company:details')
            ->setDescription('Returns detailed information about the specified company.')
            ->addOption(
                'uid',
                null,
                InputOption::VALUE_REQUIRED,
                'Company uid',
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
        $uid = $input->getOption('uid');

        try {
            /** @var Company $system */
            $company = $service->getClient('admin.company');
            $reponse = $company->getDetails($uid);
            $reponse = json_decode($reponse);
            $output->writeln(sprintf("Details of company '%s'", $reponse->name));
            $output->writeln($reponse);
        } catch (ClientException $e) {
            $output->writeln('<error>'.$e->getCode().':'.$e->getMessage().'</error>');
        }
    }
}
