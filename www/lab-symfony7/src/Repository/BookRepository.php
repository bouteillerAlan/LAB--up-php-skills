<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function findAll(): array
    {
        $bookQuery = $this->createQueryBuilder('bookQuery');
        return $bookQuery->getQuery()->getResult();
    }

    public function findOneById(int $id): Book
    {
        $bookQuery = $this->createQueryBuilder('bookQuery');
        $bookQuery->where('bookQuery.id = :id')->setParameter('id', $id);
        $r = $bookQuery->getQuery()->getOneOrNullResult();
        return $r;
    }
}
