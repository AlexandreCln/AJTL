<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthentificationFixtures extends Fixture
{
    const ADMIN_REFERENCE = 'admin';
    const PASSWORD = 'password';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setRoles([])
            ->setEmail('user@test.fr')
            ->setUsername('User')
            ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                self::PASSWORD
            ));

        $admin = new User();
        $admin
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('admin@test.fr')
            ->setUsername('Admin')
            ->setPassword($this->passwordEncoder->encodePassword(
                $admin,
                self::PASSWORD
            ));

        $this->addReference(self::ADMIN_REFERENCE, $admin);

        $manager->persist($user);
        $manager->persist($admin);
        $manager->flush();
    }
}
