<?php
/**
 * NovaeZMailingBundle Bundle.
 *
 * @package   Novactive\Bundle\eZMailingBundle
 *
 * @author    Novactive <s.morel@novactive.com>
 * @copyright 2018 Novactive
 * @license   https://github.com/Novactive/NovaeZMailingBundle/blob/master/LICENSE MIT Licence
 */
declare(strict_types=1);

namespace Novactive\Bundle\eZMailingBundle\Listener;

use Doctrine\ORM\EntityManagerInterface;
use eZ\Publish\Core\MVC\Symfony\Event\PreContentViewEvent;
use eZ\Publish\Core\MVC\Symfony\View\ContentView;
use Novactive\Bundle\eZMailingBundle\Entity\Mailing;
use Novactive\Bundle\eZMailingBundle\Security\Voter\Mailing as MailingVoter;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class PreContentView.
 */
class PreContentView
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    /**
     * PreContentView constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param RequestStack           $requestStack
     * @param AuthorizationChecker   $authorizationChecker
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        RequestStack $requestStack,
        AuthorizationChecker $authorizationChecker
    ) {
        $this->entityManager        = $entityManager;
        $this->requestStack         = $requestStack;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param PreContentViewEvent $event
     */
    public function onPreContentView(PreContentViewEvent $event): void
    {
        $contentView = $event->getContentView();
        if (!$contentView instanceof ContentView) {
            return;
        }
        if ('novaezmailingfull' !== $contentView->getViewType()) {
            return;
        }
        $masterRequest = $this->requestStack->getMasterRequest();
        if (null === $masterRequest) {
            return;
        }

        if (!$masterRequest->attributes->has('mailingId')) {
            return;
        }
        $mailing = $this->entityManager->getRepository(Mailing::class)->findOneById(
            $masterRequest->attributes->get('mailingId')
        );

        if (!$mailing instanceof Mailing) {
            return;
        }
        if (!$this->authorizationChecker->isGranted([MailingVoter::VIEW], $mailing)) {
            return;
        }
        $contentView->addParameters(['mailing' => $mailing]);
    }
}
