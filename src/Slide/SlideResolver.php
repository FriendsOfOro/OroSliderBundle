<?php


namespace SliderBundle\Slide;


use Oro\Bundle\ScopeBundle\Entity\Scope;
use SliderBundle\Entity\Slide;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class SlideResolver
{
    /** @var PropertyAccessor */
    protected $propertyAccessor;

    /**
     * @param PropertyAccessor $propertyAccessor
     */
    public function __construct(PropertyAccessor $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    public function getVisibleSlides($slides,$context)
    {
        $slidesVisibles = [];

        foreach ($slides as $slide)
        {
            if ($this->isSlideVisible($slide, $context)) {
                array_push($slidesVisibles,$slide);
            }
        }

        return $slidesVisibles;
    }

    private function isSlideVisible(Slide $slide, array $context)
    {
        $scopes = $slide->getScopes();
        if ($scopes->isEmpty()) {
            return true;
        }

        foreach ($scopes as $scope) {
            if ($this->isScopeSuitable($scope, $context)) {
                return true;
            }
        }
    }

    private function isScopeSuitable(Scope $scope, array $context)
    {
        foreach ($context as $criteriaPath => $criteriaValue) {
            $value = $this->propertyAccessor->getValue($scope, $criteriaPath);
            if ($value === null) {
                continue;
            }
            if ($value !== $criteriaValue) {
                return false;
            }
        }

        return true;
    }
}