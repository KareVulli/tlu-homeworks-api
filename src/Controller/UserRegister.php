<?php
namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRegister
{
    private $em;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function __invoke(User $data): User
    {
        $password = $this->passwordEncoder->encodePassword($data, $data->getPlainPassword());
        $data->setPassword($password);

        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }
}