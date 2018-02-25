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

namespace Novactive\Bundle\eZMailingBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Novactive\Bundle\eZMailingBundle\Entity\Registration;
use Novactive\Bundle\eZMailingBundle\Entity\User;

class UsersRegistrationsFixtures extends Fixture implements DependentFixtureInterface
{
    const FIXTURE_COUNT_USER = 100;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= self::FIXTURE_COUNT_USER; ++$i) {
            $user = new User();
            $user
                ->setEmail($faker->unique()->email)
                ->setBirthDate($faker->dateTimeThisCentury)
                ->setCity($faker->city)
                ->setCompany($faker->company)
                ->setCountry($faker->countryCode)
                ->setFirstName($faker->firstName)
                ->setLastName($faker->lastName)
                ->setGender($faker->title)
                ->setJobTitle($faker->jobTitle)
                ->setPhone($faker->phoneNumber)
                ->setState($faker->state)
                ->setZipcode($faker->postcode)
                ->setOrigin($faker->randomElement(['site', 'import']));

            $nbRegistrations = $faker->numberBetween(0, MailingListFixtures::FIXTURE_COUNT_MAILINGLIST);
            for ($j = 0; $j <= $nbRegistrations; ++$j) {
                $registration     = new Registration();
                $mailingListIndex = $faker->numberBetween(1, MailingListFixtures::FIXTURE_COUNT_MAILINGLIST);
                $registration->setMailingList($this->getReference("mailing-list-{$mailingListIndex}"));
                $user->addRegistration($registration);
            }
            $manager->persist($user);
        }
        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies(): array
    {
        return [
            MailingListFixtures::class,
        ];
    }
}