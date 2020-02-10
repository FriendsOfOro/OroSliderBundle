<?php

namespace SliderBundle\Layout\DataProvider;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\ScopeBundle\Manager\ScopeManager;
use SliderBundle\Entity\Slider;
use SliderBundle\Entity\Repository\SliderRepository;
use SliderBundle\Slide\SlideResolver;

class SliderDataProvider
{
    /**
     * @var SliderRepository
     */
    protected $sliderRepository;

    /** @var ConfigManager */
    protected $config;

    /** @var ScopeManager */
    private $scopeManager;

    /** @var SlideResolver */
    protected $slideResolver;

    /**
     * SliderDataProvider constructor.
     * @param SliderRepository $sliderRepository
     * @param ConfigManager $config
     * @param ScopeManager $scopeManager
     * @param SlideResolver $slideResolver
     */
    public function __construct(SliderRepository $sliderRepository, ConfigManager $config, ScopeManager $scopeManager, SlideResolver $slideResolver)
    {
        $this->sliderRepository = $sliderRepository;
        $this->config = $config;
        $this->scopeManager = $scopeManager;
        $this->slideResolver = $slideResolver;
    }


    /**
     * @var $string
     * @return Slider $slider
     */
    public function getSlidesBySliderCode($sliderCode)
    {
        $criteria = $this->scopeManager->getCriteria('slide');
        $context = $criteria->toArray();
        $slides = $this->sliderRepository->getSlidesBySliderCode($sliderCode);
        $slidesVisibles = $this->slideResolver->getVisibleSlides($slides,$context);
        return $slidesVisibles;
    }

    public function getSliderUsedConfig()
    {
        /** @var Slider $slider */
        $sliderId = $this->config->get('slider_bundle.slider');
        $slider = $this->sliderRepository->find($sliderId);
        if(is_null($slider))
        {
            return null;
        }
        else {
            return $this->getSlidesBySliderCode($slider->getCode());
        }
    }

}
