<?php

namespace SliderBundle;

use SliderBundle\DependencyInjection\SliderExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SliderBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        if (!$this->extension) {
            $this->extension = new SliderExtension();
        }

        return $this->extension;
    }
}
