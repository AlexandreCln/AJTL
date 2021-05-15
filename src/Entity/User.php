<?php

namespace App\Entity;

use App\Entity\Chat\Message;
use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Chat\Conversation;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email", message="Cet email est déjà utilisé.")
 * @UniqueEntity("username", message="Ce pseudo est déjà utilisé.")
 */
class User implements UserInterface
{
    // TODO: it is simpler to create OneToOne::Contact relation ? or use `contact` group for specific cases ?

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"conversation:read", "contact:read", "conversation:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Vous devez remplir ce champ.")
     * @Assert\Length(min="7", minMessage="Ce champ doit contenir au moins {{ limit }} caractères.")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Vous devez remplir ce champ.")
     * @Assert\Length(max="180", maxMessage="Ce champ doit contenir {{ limit }} caractères maximum.")
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Vous devez remplir ce champ.")
     * @Assert\Length(
     *     min="2", 
     *     max="20",
     *     minMessage="Ce champ doit contenir {{ limit }} caractères minimum.",
     *     maxMessage="Ce champ doit contenir {{ limit }} caractères maximum."
     * )
     * @Groups({
     *     "conversation:read",
     *     "conversation:list",
     *     "contact:read",
     * })
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contact:read"})
     */
    private $avatarFilename;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Chat\Conversation", mappedBy="users")
     */
    private $conversations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chat\Message", mappedBy="user")
     */
    private $messages;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getOriginalAvatarFilename(): ?string
    {
        return $this->avatarFilename;
    }

    /**
     * This isn't full path, just the part relative from wherever our app decides to store uploads.
     */
    public function getAvatarFilename(): ?string
    {
        if (!$this->avatarFilename) return null;

        return UploaderHelper::USER_AVATAR . '/' . $this->getOriginalAvatarFilename();
    }

    public function setAvatarFilename(string $avatarFilename): self
    {
        $this->avatarFilename = $avatarFilename;

        return $this;
    }

    /**
     * @return Collection|Conversation[]
     */
    public function getConversations(): Collection
    {
        return $this->conversations;
    }

    public function addConversation(Conversation $conversation): self
    {
        if (!$this->conversations->contains($conversation)) {
            $this->conversations[] = $conversation;
            $conversation->addUser($this);
        }

        return $this;
    }

    public function removeConversation(Conversation $conversation): self
    {
        if ($this->conversations->removeElement($conversation)) {
            $conversation->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }
}
