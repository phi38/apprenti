<?php
// api/src/Doctrine/CurrentUserExtension.php

namespace App\ApiPlatform;

use App\Entity\CursusFollowed;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Security;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

final class CurrentUserExtension implements QueryCollectionExtensionInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = []): void
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        if (CursusFollowed::class !== $resourceClass || $this->security->isGranted('ROLE_ADMIN') || null === $user = $this->security->getUser()) {
            return;
        }
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
        ->andWhere(sprintf('%s.profil = :current_user', $rootAlias))
        -> setParameter('current_user', $user->getProfil()->getId());
        /*
               ->andWhere(sprintf('%s.id = :current_user', $rootAlias))
        -> setParameter('current_user', 3);
*/
        /*
        $queryBuilder->andWhere(sprintf('%s.profil.id = :current_user', $rootAlias));
        $queryBuilder->setParameter('current_user', 3);
        */
    }
}