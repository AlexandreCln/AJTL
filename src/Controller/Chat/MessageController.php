<?php

namespace App\Controller\Chat;

use App\Entity\Message;
use App\Entity\Conversation;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ConversationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

/**
 * @Route("/api/messages", name="api_messages_")
 */
class MessageController extends AbstractController
{
    // /**
    //  * @Route("/publish-message", name="publish_message", methods={"POST"})
    //  */
    // public function publishMessage(): JsonResponse
    // {
    // }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(
        Request $request,
        SerializerInterface $serializer,
        EntityManagerInterface $em,
        ValidatorInterface $validator
    ): JsonResponse {
        // TODO: add Entities's validations (for $content) and (maybe ?) disable csrf protection like this
        // public function configureOptions(OptionsResolver $resolver)
        // {
        //     $resolver->setDefaults([
        //         'data_class' => 'App\Entity\Message',
        //         'csrf_protection'   => false
        //     ]);
        //     return;
        // }

        try {
            $message = $serializer->deserialize($request->getContent(), Message::class, 'json');
            $errors = $validator->validate($message);

            if (count($errors)) {
                return $this->json($errors, Response::HTTP_BAD_REQUEST);
            }

            $em->persist($message);
            $em->flush();

            return $this->json($message, Response::HTTP_CREATED, [], ['groups' => 'message:read']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status'  => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ]);
        }
    }
}
