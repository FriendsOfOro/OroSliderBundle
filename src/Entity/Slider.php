<?php

namespace SliderBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\OrganizationBundle\Entity\Ownership\OrganizationAwareTrait;


/**
 * @ORM\Table(name="kiboko_slider")
 * @ORM\Entity(repositoryClass="SliderBundle\Entity\Repository\SliderRepository")
 * @Config(
 *     defaultValues={
 *          "dataaudit"={
 *              "auditable"=true
 *          },
 *          "ownership"={
 *              "owner_type"="ORGANIZATION",
 *              "owner_field_name"="organization",
 *              "owner_column_name"="organization_id",
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"="commerce"
 *          }
 *      }
 * )
 */
class Slider implements
    OrganizationAwareInterface,
    DatesAwareInterface
{
    use DatesAwareTrait;
    use OrganizationAwareTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @ORM\OneToMany(
     *     targetEntity="SliderBundle\Entity\Slide",
     *     mappedBy="slider",
     *     cascade={"all"},
     *     orphanRemoval=true
     * )
     */
    private $slides;

    /**
     * Slide constructor.
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
    }
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }


    public function getSlides(): ?Collection
    {
        return $this->slides;
    }
    public function setSlides($slides): void
    {
        $this->slides = $slides;
    }

    public function addSlide($slide): void
    {
        $this->slides->add($slide);
    }

    public function removeSlide($slide): void
    {
        $this->slides->remove($slide);
    }
}
