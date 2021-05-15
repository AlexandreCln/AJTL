<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Asset\Context\RequestStackContext;

class UploaderHelper
{
    /* List sub directories names in one place */
    const USER_AVATAR = 'user_avatar';
    const PRESENTATION_PERSON_PICTURE = 'presentation_person_picture';

    private $uploadsPath;
    private $publicAssetBaseUrl;
    private $requestStackContext;

    public function __construct(string $uploadsPath, string $uploadedAssetsBaseUrl, RequestStackContext $requestStackContext)
    {
        $this->uploadsPath = $uploadsPath;
        $this->publicAssetBaseUrl = $uploadedAssetsBaseUrl;
        $this->requestStackContext = $requestStackContext;
    }

    public function upload(File $file, string $subDirectory): string
    {
        $destination = $this->uploadsPath . '/' . $subDirectory;

        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $slugger = new AsciiSlugger();
        $newFilename = $slugger->slug(pathinfo($originalFilename, PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->guessExtension();

        $file->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    /**
     * Concatenate the path where we store uploaded assets with the given path.
     */
    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext->getBasePath() . $this->publicAssetBaseUrl . '/' . $path;
    }
}
