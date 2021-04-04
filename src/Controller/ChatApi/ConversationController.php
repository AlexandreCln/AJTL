<?php

namespace App\Controller\ChatApi;

use App\Entity\Conversation;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ConversationRepository;
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
 * @Route("/api/conversations", name="api_conversations_")
 */
class ConversationController extends AbstractController
{
    // TODO: Gestion des erreurs:
    // https://openclassrooms.com/fr/courses/4087036-construisez-une-api-rest-avec-symfony/4333906-gestion-des-erreurs

    // Création    •  POST /conversations 
    // Lecture     •  GET /conversations  ou  GET /conversations/{id} 
    // Mise à jour •  PUT /conversations/{id} 
    // Suppression •  DELETE /conversations/{id} 

    /**
     * @Route("/", name="get_user_conversations", methods={"GET"})
     */
    public function getUserConversations(Request $request, UserRepository $userRepo): JsonResponse
    {
        $user = $userRepo->findOneBy($request->get('userId'));
        $conversations = $user->getConversations();

        return $this->json($conversations, Response::HTTP_OK, [], ['groups' => 'conversation:list']);
    }

    /**
     * @Route("/", name="create", methods={"POST"})
     */
    public function create(Request $request, ConversationRepository $conversationRepo): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $userIds = $data['userIds'];
        // $users = ;

        if (empty($userIds)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $conversation = $conversationRepo->createConversationByUsers();

        return new JsonResponse(['status' => 'Customer created!'], Response::HTTP_CREATED);
        return $this->json($conversation, Response::HTTP_CREATED, [], ['groups' => 'conversation:read']);
    }

    /**
     * @Route("/{id}", name="delete", methods={"GET"})
     */
    public function delete(
        int $id,
        ConversationRepository $conversationRepo,
        EntityManagerInterface $em
    ): JsonResponse {
        $conversation = $conversationRepo->find($id);

        if ($conversation) {
            $em->remove($conversation);
            $em->flush();
        }

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/conservations/{id}/messages", name="list_conversation_messages", methods={"GET"})
     */
    public function listMessagesByConversation(Request $request, Conversation $conversation): JsonResponse
    {
        // TODO: prévoir pagination
        // $page = $request->get('page');
        // $pageLimit = $request->get('pageLimit');

        $messages = $conversation->getMessages();

        return $this->json($messages, Response::HTTP_OK, [], ['groups' => 'message:read']);
    }

    // /**
    //  * @Route("/", name="create", methods={"POST"})
    //  */
    // public function create(
    //     Request $request,
    //     SerializerInterface $serializer,
    //     EntityManagerInterface $em,
    //     ValidatorInterface $validator
    // ): JsonResponse {
    //     try {
    //         $conv = $serializer->deserialize($request->getContent(), Conversation::class, 'json');
    //         // TODO: add Entities's validations
    //         $errors = $validator->validate($conv);

    //         if (count($errors)) {
    //             return $this->json($errors, Response::HTTP_BAD_REQUEST);
    //         }

    //         $em->persist($conv);
    //         $em->flush();

    //         return $this->json($conv, Response::HTTP_CREATED, [], ['groups' => 'conversation:read']);
    //     } catch (NotEncodableValueException $e) {
    //         return $this->json([
    //             'status'  => Response::HTTP_BAD_REQUEST,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }
}
