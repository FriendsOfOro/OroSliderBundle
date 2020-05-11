<?php

namespace SliderBundle\Layout\DataProvider;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\ScopeBundle\Manager\ScopeManager;
use Oro\Bundle\SecurityBundle\Authentication\TokenAccessorInterface;
use SliderBundle\Entity\Slider;
use SliderBundle\Entity\Repository\SliderRepository;
use SliderBundle\Slide\SlideResolver;

class SliderDataProvider
{
    /** @var SliderRepository */
    protected $sliderRepository;

    /** @var ConfigManager */
    protected $config;

    /** @var ScopeManager */
    private $scopeManager;

    /** @var SlideResolver */
    protected $slideResolver;

    /** @var TokenAccessorInterface */
    protected $tokenAccessor;

    /**
     * SliderDataProvider constructor.
     * @param SliderRepository $sliderRepository
     * @param ConfigManager $config
     * @param ScopeManager $scopeManager
     * @param SlideResolver $slideResolver
     * @param TokenAccessorInterface $tokenAccessor
     */
    public function __construct(SliderRepository $sliderRepository, ConfigManager $config, ScopeManager $scopeManager, SlideResolver $slideResolver, TokenAccessorInterface $tokenAccessor)
    {
        $this->sliderRepository = $sliderRepository;
        $this->config = $config;
        $this->scopeManager = $scopeManager;
        $this->slideResolver = $slideResolver;
        $this->tokenAccessor= $tokenAccessor;
    }

    /**
     * @var $string
     * @return array $slider
     */
    public function getSlidesBySliderCode($sliderCode)
    {
        $criteria = $this->scopeManager->getCriteria('slide');
        $context = $criteria->toArray();
        $slides = $this->sliderRepository->getSlidesBySliderCode($sliderCode, $this->tokenAccessor->getOrganization());
        $slidesVisibles = $this->slideResolver->getVisibleSlides($slides, $context);
        if (!is_null($slidesVisibles)) {
            return $slidesVisibles;
        }
        return [];
    }

    public function getSliderUsedConfig()
    {
        /** @var Slider $slider */
        $sliderId = $this->config->get('slider_bundle.slider');
        if (!is_null($sliderId)) {
            return $this->sliderRepository->find($sliderId);
        }
        return null;
    }

    public function getSliderCodeUsedConfig()
    {
        $slider = $this->getSliderUsedConfig();
        if (!is_null($slider)) {
            return $slider->getCode();
        }
        return null;
    }
}
