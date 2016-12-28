<?php

namespace Ds\Bundle\BpmCamundaBundle\Migrations\Data\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Ds\Bundle\UserBundle\Migration\Extension\UserExtensionAwareInterface;
use Ds\Bundle\UserBundle\Migration\Extension\UserExtensionAwareTrait;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class LoadUserData
 */
class LoadUserData extends AbstractFixture implements DependentFixtureInterface, UserExtensionAwareInterface, ContainerAwareInterface
{
    use UserExtensionAwareTrait;
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [
            'Oro\Bundle\OrganizationBundle\Migrations\Data\ORM\LoadOrganizationAndBusinessUnitData'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        // @todo Remove once auto injection via UserExtensionAwareInterface gets added.
        $this->setUserExtension($this->container->get('ds.user.migration.extension.user'));
        //

        $resource = __DIR__.'/../../../Resources/data/users.yml';
        $this->userExtension->import($resource, $manager);
    }
}
