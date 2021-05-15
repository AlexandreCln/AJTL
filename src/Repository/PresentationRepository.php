<?php

namespace App\Repository;

use App\Entity\Presentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Presentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Presentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Presentation[]    findAll()
 * @method Presentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Presentation::class);
    }

    /**
     * Get or creates the unique row of `presentation` table.
     */
    public function getUniqueEntity(): Presentation
    {
        $uniqueEntity = $this->findOneBy([]);

        if (!$uniqueEntity instanceof Presentation) {
            $uniqueEntity = new Presentation;
            $this->getEntityManager()->persist($uniqueEntity);
            $this->getEntityManager()->flush();
        }

        return $uniqueEntity;
    }
}
