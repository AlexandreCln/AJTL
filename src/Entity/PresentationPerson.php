<?php

namespace App\Entity;

use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PresentationPersonRepository")
 */
class PresentationPerson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pictureFilename;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getOriginalPictureFilename(): ?string
    {
        return $this->pictureFilename;
    }

    /**
     * This isn't full path, just the part relative from wherever our app decides to store uploads.
     */
    public function getPictureFilename(): string
    {
        return UploaderHelper::PRESENTATION_PERSON_PICTURE . '/' . $this->getOriginalPictureFilename();
    }

    public function setPictureFilename(string $pictureFilename): self
    {
        $this->pictureFilename = $pictureFilename;

        return $this;
    }
}
