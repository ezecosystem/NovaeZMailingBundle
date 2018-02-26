<?php
/**
 * NovaeZMailingBundle Bundle.
 *
 * @package   Novactive\Bundle\eZMailingBundle
 *
 * @author    Novactive <s.morel@novactive.com>
 * @copyright 2018 Novactive
 * @license   https://github.com/Novactive/eZMailingBundle/blob/master/LICENSE MIT Licence
 */
declare(strict_types=1);

namespace Novactive\Bundle\eZMailingBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping\PostLoad;
use eZ\Publish\API\Repository\Repository;
use Novactive\Bundle\eZMailingBundle\Entity\eZ\ContentInterface;

/**
 * Class ContentLink
 * Link an eZ Content to an Entity.
 */
class EntityContentLink
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * EntityContentLink constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /** @PostLoad */
    public function postLoadHandler(ContentInterface $entity, LifecycleEventArgs $event): void
    {
        $content = $this->repository->getContentService()->loadContent($entity->getContentId());
        $entity->setContent($content);
    }
}