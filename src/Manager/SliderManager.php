<?php

namespace SliderBundle\Manager;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Oro\Bundle\FrontendBundle\Request\FrontendHelper;
use SliderBundle\Entity\Slider;

class SliderManager
{
    /**
     * @var ManagerRegistry
     */
    protected $managerRegistry;

    /**
     * @var FrontendHelper
     */
    protected $frontendHelper;

    /**
     * @param ManagerRegistry $managerRegistry
     * @param FrontendHelper $frontendHelper
     */
    public function __construct(ManagerRegistry $managerRegistry, FrontendHelper $frontendHelper)
    {
        $this->managerRegistry = $managerRegistry;
        $this->frontendHelper = $frontendHelper;
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this->managerRegistry->getManagerForClass(Slider::class);
    }

}
