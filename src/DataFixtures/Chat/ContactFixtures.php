<?php

namespace App\DataFixtures\Chat;

use App\Entity\User;
use App\Service\UploaderHelper;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class ContactFixtures extends Fixture
{
    public const CONTACT_REFERENCE = 'contact';

    private const TOTAL_CONTACT = 12;
    private const AVATAR_IMAGE = 'avatar.jpeg';

    private $uploader;

    public function __construct(UploaderHelper $uploader)
    {
        $this->uploader = $uploader;
    }

    public function load(ObjectManager $manager)
    {
        $avatarFilename = $this->fakeUploadAvatar();

        for ($i = 0; $i < self::TOTAL_CONTACT; $i++) {
            $user = (new User())
                ->setRoles([])
                ->setEmail('contact' . $i . '@test.fr')
                ->setUsername("Contact $i")
                ->setPassword('password')
                ->setAvatarFilename($avatarFilename);

            $this->addReference(self::CONTACT_REFERENCE . $i, $user);
        }
    }

    private function fakeUploadAvatar(): string
    {
        // as $uploader use move() we need to create a copy to reuse the image later
        $fs = new Filesystem;
        $targetPath = sys_get_temp_dir() . '/' . self::AVATAR_IMAGE;
        $fs->copy(__DIR__ . '/images/' . self::AVATAR_IMAGE, $targetPath, true);
        // upload the new image File with the copy from tmp folder
        $avatarFilename = $this->uploader->upload(new File($targetPath), UploaderHelper::USER_AVATAR);

        return $avatarFilename;
    }
}
