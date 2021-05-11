<?php

namespace App\DataFixtures\Chat;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public const CONTACT_REFERENCE = 'contact';
    public const TOTAL_CONTACT = 12;

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < self::TOTAL_CONTACT; $i++) {
            $user = (new User())
                ->setRoles([])
                ->setEmail('contact' . $i . '@test.fr')
                ->setUsername("Contact $i")
                ->setPassword('password');
            // ->setImage("https://placekitten.com/2$i/2$i");

            $this->addReference(self::CONTACT_REFERENCE . $i, $user);
        }
    }
}
