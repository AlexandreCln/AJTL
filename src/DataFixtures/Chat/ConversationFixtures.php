<?php

namespace App\DataFixtures\Chat;

use App\Entity\Chat\Conversation;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Chat\ContactFixtures;
use App\DataFixtures\Chat\MessageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\AuthentificationFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ConversationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $admin = $this->getReference(AuthentificationFixtures::ADMIN_REFERENCE);
        $contact1 = $this->getReference(ContactFixtures::CONTACT_REFERENCE . 1);
        $contact2 = $this->getReference(ContactFixtures::CONTACT_REFERENCE . 2);

        /* Conversation 1 */
        $conv1 = new Conversation();
        $conv1->addUser($admin);
        $conv1->addUser($contact1);

        for ($i = 0; $i < count(MessageFixtures::DIALOG_MESSAGES); $i++) {
            $message = $this->getReference(MessageFixtures::DIALOG_MESSAGE_REFERENCE . $i);
            $conv1->addMessage($message);

            if ($i % 2) {
                $contact1->addMessage($message);
            } else {
                $admin->addMessage($message);
            }
        }

        $manager->persist($conv1);

        /* Conversation 2 */
        $conv2 = new Conversation();
        $conv2->addUser($this->getReference(AuthentificationFixtures::ADMIN_REFERENCE));
        $conv2->addUser($contact1);
        $conv2->addUser($contact2);

        for ($i = 0; $i < 10; $i++) {
            $messageKey = rand(0, MessageFixtures::TOTAL_RANDOM_MESSAGES - 1);
            $message = $this->getReference(MessageFixtures::RANDOM_MESSAGE_REFERENCE . $messageKey);
            $conv2->addMessage($message);

            $contactKey = rand(1, 3);

            switch ($contactKey) {
                case 1:
                    $contact1->addMessage($message);
                    break;
                case 2:
                    $contact2->addMessage($message);
                    break;
                case 3:
                    $admin->addMessage($message);
                    break;
            }
        }

        $manager->persist($conv2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AuthentificationFixtures::class,
            ContactFixtures::class,
            MessageFixtures::class,
        ];
    }
}
