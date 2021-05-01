<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    const PASSWORD = 'password';

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = (new User())
            ->setRoles([])
            ->setEmail('user@test.fr')
            ->setUsername('User');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            self::PASSWORD
        ));

        $manager->persist($user);

        $admin = (new User())
            ->setRoles(['ROLE_ADMIN'])
            ->setEmail('admin@test.fr')
            ->setUsername('Admin');

        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            self::PASSWORD
        ));

        $manager->persist($admin);

        $manager->flush();
    }
}
