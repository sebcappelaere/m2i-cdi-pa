<?php


namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Vendeur;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class VendeurFixtures extends AbstractFixture implements OrderedFixtureInterface
{


    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {


        $vendeur = new Vendeur();
        $vendeur->setFirstName("Jean")
            ->setName("VEND")
            ->setEmail("jean.vend@annonce.fr")
            ->setPassword('123');

        $manager->persist($vendeur);
        $this->setReference("jean_vend", $vendeur);


        $vendeur = new Vendeur();
        $vendeur->setFirstName("Sébastien")
            ->setName("CAPPELAERE")
            ->setEmail("sebastien.cappelaere@annonce.fr")
            ->setPassword('123');
        $manager->persist($vendeur);
        $this->setReference("sebastien_cappelaere", $vendeur);

        $vendeur = new Vendeur();
        $vendeur->setFirstName("Philippe")
            ->setName("MACRON")
            ->setEmail("philippe.macron@annonce.fr")
            ->setPassword('123');
        $manager->persist($vendeur);
        $this->setReference("philippe_macron", $vendeur);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}