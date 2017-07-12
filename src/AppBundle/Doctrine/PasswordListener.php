<?php
namespace AppBundle\Doctrine;


use AppBundle\Entity\Vendeur;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordListener
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * PasswordListener constructor.
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();
        if(! $entity instanceof Vendeur){
            return;
        }

        $entity->setSalt(sha1(uniqid()));

        $encoded = $this->encoder->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
        $entity->setPlainPassword(null);
    }
}