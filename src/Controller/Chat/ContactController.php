<?php

namespace App\Controller\Chat;

use App\Entity\Chat\Conversation;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Chat\ConversationRepository;
use App\Service\UploaderHelper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

/**
 * @Route("/api/chat/contacts", name="api_contacts_")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", name="get_contacts", methods={"GET"})
     */
    public function getContacst(UserRepository $userRepo, UploaderHelper $uploader): JsonResponse
    {
        $contacts = $userRepo->findAll();

        $avatarFilename = $contacts[3]->getAvatarFilename();
        dd($uploader->getPublicPath($avatarFilename));

        return $this->json($contacts, Response::HTTP_OK, [], ['groups' => 'contact:read']);
    }

    /**
     * @Route("/{contactId}", name="get_contact", methods={"GET"})
     */
    public function getContact(int $contactId, UserRepository $userRepo): JsonResponse
    {
        $contact = $userRepo->find($contactId);

        return $this->json($contact, Response::HTTP_OK, [], ['groups' => 'user:read']);
    }
}
