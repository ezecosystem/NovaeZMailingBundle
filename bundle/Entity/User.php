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

namespace Novactive\Bundle\eZMailingBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class User.
 *
 * @ORM\Table(name="novaezmailing_user",
 *            uniqueConstraints={ @ORM\UniqueConstraint(name="unique_email",columns={"USER_email"})}
 * )
 *
 * @ORM\Entity(repositoryClass="Novactive\Bundle\eZMailingBundle\Repository\User")
 * @UniqueEntity("email")
 */
class User
{
    use Compose\Metadata;
    use Compose\Remote;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->registrations = new ArrayCollection();
    }

    /**
     * @var int
     * @ORM\Column(name="USER_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="USER_email", type="string", length=255, nullable=false)
     * @Assert\NotBlank
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="USER_first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(name="USER_last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     * @ORM\Column(name="USER_gender", type="string", length=255, nullable=true)
     */
    private $gender;

    /**
     * @var DateTime
     * @ORM\Column(name="USER_birth_date", type="date", nullable=true)
     */
    private $birthDate;

    /**
     * @var string
     * @ORM\Column(name="USER_phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="USER_zipcode", type="string", length=255, nullable=true)
     */
    private $zipcode;

    /**
     * @var string
     * @ORM\Column(name="USER_city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="USER_state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string
     * @ORM\Column(name="USER_country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string
     * @ORM\Column(name="USER_job_title", type="string", length=255, nullable=true)
     */
    private $jobTitle;

    /**
     * @var string
     * @ORM\Column(name="USER_company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     * @ORM\Column(name="USER_origin", type="string", length=255, nullable=false)
     */
    private $origin;

    /**
     * @var Registration[]
     * @ORM\OneToMany(targetEntity="Novactive\Bundle\eZMailingBundle\Entity\Registration", mappedBy="user",
     *                                                                                     cascade={"persist","remove"},
     *                                                                                     orphanRemoval=true
     * )
     */
    protected $registrations;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     *
     * @return User
     */
    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     *
     * @return User
     */
    public function setBirthDate(DateTime $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return User
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     *
     * @return User
     */
    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return User
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     *
     * @return User
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return User
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     *
     * @return User
     */
    public function setJobTitle(string $jobTitle): self
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     *
     * @return User
     */
    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     *
     * @return User
     */
    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * @return ArrayCollection|Registration[]
     */
    public function getRegistrations()
    {
        return $this->registrations;
    }

    /**
     * @param Registration[] $registrations
     *
     * @return MailingList
     */
    public function setRegistrations(array $registrations): self
    {
        foreach ($registrations as $registration) {
            if (!$registration instanceof Registration) {
                throw new \RuntimeException(sprintf('Provided Registration is not a %s', Registration::class));
            }
        }
        $this->registrations = $registrations;

        return $this;
    }

    /**
     * @param Registration $registration
     *
     * @return $this
     */
    public function addRegistration(Registration $registration): self
    {
        if ($this->registrations->contains($registration)) {
            return $this;
        }

        if ($this->registrations->exists(
            function ($key, Registration $element) use ($registration) {
                return $element->getMailingList()->getId() === $registration->getMailingList()->getId();
            }
        )) {
            return $this;
        }
        $registration->setUser($this);
        $this->registrations->add($registration);

        return $this;
    }
}