<?php

namespace App\DataFixtures\Chat;

use App\Entity\Chat\Message;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\HttpClient\HttpClient;

class MessageFixtures extends Fixture
{
    public const RANDOM_MESSAGE_REFERENCE = 'random-message';
    public const TOTAL_RANDOM_MESSAGES = 30;

    public const DIALOG_MESSAGE_REFERENCE = 'dialog-message';
    public const DIALOG_MESSAGES = [
        'Salut !',
        'Hey :)',
        'On se fait un jeu de société ?',
        'Grave !',
        'Plûtot un RISK ou 7 Wonders ?',
        'Hmmm... plûtot 7 Wonders, on est sûr d\'avoir le temps de finir la partie',
        'T\'as raison, c\'est moins RISKé :p',
        '...',
    ];

    public function load(ObjectManager $manager)
    {
        $client = HttpClient::create();

        /* Random Messages */
        for ($i = 0; $i < self::TOTAL_RANDOM_MESSAGES; $i++) {
            $message = (new Message)->setContent(
                $client->request('GET', 'https://api.chucknorris.io/jokes/random')->toArray()['value']
            );
            $manager->persist($message);
            $this->addReference(self::RANDOM_MESSAGE_REFERENCE . $i, $message);
        }

        /* Dialog Messages */
        for ($i = 0; $i < count(self::DIALOG_MESSAGES); $i++) {
            $message = (new Message)->setContent(self::DIALOG_MESSAGES[$i]);
            $manager->persist($message);
            $this->addReference(self::DIALOG_MESSAGE_REFERENCE . $i, $message);
        }

        $manager->flush();
    }
}
