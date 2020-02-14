<?php

namespace SliderBundle\EventListener;

use Doctrine\Common\Persistence\ManagerRegistry;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;
use Oro\Bundle\ConfigBundle\Event\ConfigSettingsUpdateEvent;
use SliderBundle\DependencyInjection\SliderExtension;

class SystemConfigListener
{
    const SETTING = 'slider';

    /**
     * @var ManagerRegistry
     */
    protected $registry;

    /**
     * @var string
     */
    protected $sliderClass;

    /**
     * @param ManagerRegistry $registry
     * @param string $userClass
     */
    public function __construct(ManagerRegistry $registry, $userClass)
    {
        $this->registry = $registry;
        $this->sliderClass = $userClass;
    }

    /**
     * @param ConfigSettingsUpdateEvent $event
     */
    public function onFormPreSetData(ConfigSettingsUpdateEvent $event)
    {
        $settingsKey = implode(ConfigManager::SECTION_VIEW_SEPARATOR, [SliderExtension::ALIAS, self::SETTING]);
        $settings = $event->getSettings();
        if (is_array($settings)
            && !empty($settings[$settingsKey]['value'])
        ) {
            $settings[$settingsKey]['value'] = $this->registry
                ->getManagerForClass($this->sliderClass)
                ->find($this->sliderClass, $settings[$settingsKey]['value']);
            $event->setSettings($settings);
        }
    }

    /**
     * @param ConfigSettingsUpdateEvent $event
     */
    public function onSettingsSaveBefore(ConfigSettingsUpdateEvent $event)
    {
        $settings = $event->getSettings();

        if (!array_key_exists('value', $settings)) {
            return;
        }

        if (!is_a($settings['value'], $this->sliderClass)) {
            return;
        }

        /** @var object $owner */
        $slider = $settings['value'];
        $settings['value'] = $slider->getId();
        $event->setSettings($settings);
    }
}
