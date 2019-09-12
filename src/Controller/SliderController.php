<?php

namespace SliderBundle\Controller;

use SliderBundle\Entity\Slider;
use SliderBundle\Form\Type\SliderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SliderController extends Controller
{
    /**
     * @Route("/", name="kiboko_slider_index")
     * @Template
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'gridName' => 'kiboko-slider-grid'
        ];
    }

    /**
     * @Route("/create", name="kiboko_slider_create")
     * @Template("SliderBundle:Slider:update.html.twig")
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function createAction(Request $request)
    {
        return $this->update(new Slider(), $request);
    }

    /**
     * @Route("/update/{id}", name="kiboko_slider_update", requirements={"id"="\d+"})
     * @Template
     *
     * @param Slider $slider
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function updateAction(Slider $slider, Request $request)
    {
        return $this->update($slider, $request);
    }

    protected function update(Slider $slider, Request $request)
    {
        return $this->get('oro_form.update_handler')->update(
            $slider,
            $this->createForm(SliderType::class, $slider),
            $this->get('translator')->trans('kiboko.slider.form.update.messages.saved'),
            $request,
            null
        );
    }

    /**
     * @Route("/view/{id}", name="kiboko_slider_view", requirements={"id"="\d+"})
     *
     * @Template()
     *
     * @param Slider $slider
     * @return array
     */
    public function viewAction(Slider $slider)
    {
        return [
            'entity' => $slider
        ];
    }

    /**
     * @Route("/delete/{id}", name="kiboko_slider_delete", requirements={"id"="\d+"})
     *
     * @param Slider $slider
     * @return Response
     */
    public function deleteAction(Slider $slider)
    {
        $em = $this->get('doctrine')->getManager();
        $em->remove($slider);
        $em->flush();

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}
