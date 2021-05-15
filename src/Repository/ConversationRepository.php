<?php

namespace App\Repository;

use App\Entity\Chat\Conversation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Conversation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conversation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conversation[]    findAll()
 * @method Conversation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConversationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conversation::class);
    }

    // /**
    //  * @return Conversation
    //  */
    // public function findConversationByParticipants(int ...$participantIds): ?Conversation
    // {
    //     dd($participant);
    //     $qb = $this->createQueryBuilder('c');
    //     $qb
    //         ->select($qb->expr()->count('p.conversation'))
    //         ->innerJoin('c.participants', 'p')
    //         ->where(
    //             $qb->expr()->orX(
    //                 $qb->expr()->eq('p.user', ':me'),
    //                 $qb->expr()->eq('p.user', ':otherUser')
    //             )
    //         )
    //         ->groupBy('p.conversation')
    //         ->having(
    //             $qb->expr()->eq(
    //                 $qb->expr()->count('p.conversation'),
    //                 2
    //             )
    //         )
    //         ->setParameters([
    //             'me' => $myId,
    //             'otherUser' => $otherUserId
    //         ])
    //     ;

    //     foreach ($participantIds as $id) {
    //         $qb->andWhere(
    //             $qb->expr()->orX(
    //                 $qb->expr()->eq('p.user', ':me'),
    //                 $qb->expr()->eq('p.user', ':otherUser')
    //             )
    //         )
    //     }

    //     return $qb->getQuery()->getResult();
    // }


    /*
    public function findOneBySomeField($value): ?Conversation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
