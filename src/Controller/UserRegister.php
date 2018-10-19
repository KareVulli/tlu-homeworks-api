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

        // If no users exist. make the user admin.
        $repository = $this->em->getRepository(User::class);
        $qb = $repository->createQueryBuilder('u')->select('COUNT(u)');
        $count = $qb->getQuery()->getSingleScalarResult();
        if ($count == 0) {
            $data->setAdmin(true);
        }

        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }
}