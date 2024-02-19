<?php

// src/Repository/ExcuseRepository.php

namespace App\Repository;

use App\Entity\Excuse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExcuseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Excuse::class);
    }

    // Méthode pour récupérer une excuse aléatoire
    public function findRandomExcuse(): ?Excuse
    {
        $count = $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $randomIndex = rand(0, $count - 1);

        return $this->createQueryBuilder('e')
            ->setMaxResults(1)
            ->setFirstResult($randomIndex)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAvailableHttpCodes(): array
{
    $query = $this->createQueryBuilder('e')
        ->select('e.httpCode')
        ->getQuery();

    $result = $query->getResult();

    // Extraire les codes HTTP de la liste
    $httpCodes = array_map(function($item) {
        return $item['httpCode'];
    }, $result);

    return $httpCodes;
}
}
