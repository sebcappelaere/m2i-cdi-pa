<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Annonce;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 07/07/2017
 * Time: 14:27
 */
class AnnonceFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $annonce = new Annonce();
        $annonce->setTitre("Annonce n°1")
            ->setDescription("Ceci est la première annonce")
            ->setPrice("500")
            ->setCodePostal("59250")
            ->setVendeur($this->getReference("sebastien_cappelaere"));
        $manager->persist($annonce);

        $annonce = new Annonce();
        $annonce->setTitre("Annonce n°2")
            ->setDescription("Ceci est la deuxième annonce")
            ->setPrice("2500")
            ->setCodePostal("59000")
            ->setVendeur($this->getReference("jean_vend"));
        $manager->persist($annonce);

        $annonce = new Annonce();
        $annonce->setTitre("Annonce n°3")
            ->setDescription("Ceci est la troisième annonce")
            ->setPrice("20500")
            ->setCodePostal("59150")
            ->setVendeur($this->getReference("sebastien_cappelaere"));
        $manager->persist($annonce);

        $annonce = new Annonce();
        $annonce->setTitre("Annonce n°4")
            ->setDescription("Ceci est la quatrième annonce")
            ->setPrice("1000")
            ->setCodePostal("59250")
            ->setVendeur($this->getReference("philippe_macron"));
        $manager->persist($annonce);

        $annonce = new Annonce();
        $annonce->setTitre("Annonce n°5")
            ->setDescription("Ceci est la cinquième annonce")
            ->setPrice("8200")
            ->setCodePostal("59200")
            ->setVendeur($this->getReference("jean_vend"));
        $manager->persist($annonce);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}