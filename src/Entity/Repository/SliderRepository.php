<?php

namespace SliderBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use SliderBundle\Entity\Slide;
use SliderBundle\Entity\Slider;

class SliderRepository extends EntityRepository
{
    public function findOneByCode($sliderCode)
    {
        $qb = $this->createQueryBuilder('slider');

        $slider = $qb
            ->select('slider')
            ->andWhere('slider.code = :code')
            ->setParameter('code', $sliderCode)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        return $slider;
    }

    public function getSlidesBySliderCode($sliderCode, $organization)
    {
        $date = date('Y-m-d H:i:s');
        $qb = $this->getEntityManager()->createQueryBuilder();
        $slides = $qb
            ->select('slide')
            ->from(Slide::class, 'slide')
            ->from(Slider::class,'slider')
            ->where('slide.slider = slider')
            ->andWhere('slider.code = :sliderCode')
            ->andWhere('slide.enabled = true')
            ->andWhere('slide.startedAt <= :date')
            ->andWhere('slide.expiredAt >= :date')
            ->andWhere('slider.organization = :organization')
            ->orderBy('slide.sortOrder', 'ASC')
            ->setParameter('sliderCode', $sliderCode)
            ->setParameter('date', $date)
            ->setParameter('organization', $organization)
            ->getQuery()
            ->getResult();

        return $slides;
    }
}
