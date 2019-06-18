<?php

namespace SliderBundle\Layout\DataProvider;

use SliderBundle\Entity\Slider;
use SliderBundle\Entity\Repository\SliderRepository;

class SliderDataProvider
{
    /**
     * @var SliderRepository
     */
    protected $sliderRepository;

    public function __construct(
        SliderRepository $sliderRepository
    ) {
        $this->sliderRepository = $sliderRepository;
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
}
