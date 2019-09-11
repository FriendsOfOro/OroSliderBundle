<?php

namespace SliderBundle\Layout\DataProvider;

use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use SliderBundle\Entity\Slider;
use SliderBundle\Entity\Repository\SliderRepository;

class SliderDataProvider
{
    /**
     * @var SliderRepository
     */
    protected $sliderRepository;

    /** @var ConfigManager */
    protected $config;

    /**
     * SliderDataProvider constructor.
     * @param SliderRepository $sliderRepository
     * @param ConfigManager $config
     */
    public function __construct(SliderRepository $sliderRepository, ConfigManager $config)
    {
        $this->sliderRepository = $sliderRepository;
        $this->config = $config;
    }


    /**
     * @var $string
     * @return Slider $slider
     */
    public function getSlidesBySliderCode($sliderCode)
    {
        $slider = $this->sliderRepository->getSlidesBySliderCode($sliderCode);
        return $slider;
    }

    public function getSliderUsedConfig()
    {
        /** @var Slider $slider */
        $slider = $this->config->get('slider_bundle.slider_used');
        if(is_null($slider))
        {
            return null;
        }
        else {
            return $this->getSlidesBySliderCode($slider->getCode());
        }
    }
}
