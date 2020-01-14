<?php

namespace SliderBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use SliderBundle\Entity\Slide;
use SliderBundle\Form\Type\SlideType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class SlideController extends Controller
{
    /**
     * @Route("/", name="kiboko_slide_index")
     * @Template
     * @Acl(
     *   id="kiboko_slide_view",
     *   type="entity",
     *   class="SliderBundle:Slide",
     *   permission="VIEW"
     * )
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'gridName' => 'kiboko-slide-grid'
        ];
    }

    /**
     * @Route("/create", name="kiboko_slide_create")
     * @Template("SliderBundle:Slide:update.html.twig")
     * @Acl(
     *   id="kiboko_slide_create",
     *   type="entity",
     *   class="SliderBundle:Slide",
     *   permission="CREATE"
     * )
     *
     * @param Request $request
     * @return array|RedirectResponse
     */
    public function createAction(Request $request)
    {
        return $this->update(new Slide(), $request);
    }

    /**
     * @Route("/update/{id}", name="kiboko_slide_update", requirements={"id"="\d+"})
     * @Template
     * @Acl(
     *   id="kiboko_slide_update",
     *   type="entity",
     *   class="SliderBundle:Slide",
     *   permission="UPDATE"
     * )
     *
     * @param Slide $slide
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function updateAction(Slide $slide, Request $request)
    {
        return $this->update($slide, $request);
    }

    protected function update(Slide $slide, Request $request)
    {
        return $this->get('oro_form.update_handler')->update(
            $slide,
            $this->createForm(SlideType::class, $slide),
            $this->get('translator')->trans('kiboko.slide.form.update.messages.saved'),
            $request,
            null
        );
    }

    /**
     * @Route("/view/{id}", name="kiboko_slide_view", requirements={"id"="\d+"})
     *
     * @Template()
     * @AclAncestor("kiboko_slide_view")
     *
     * @param Slide $slide
     * @return array
     */
    public function viewAction(Slide $slide)
    {
        $scopeEntities = $this->get('oro_scope.scope_manager')->getScopeEntities('slide');

        return [
            'entity' => $slide,
            'scopeEntities' => array_reverse($scopeEntities)
        ];
    }
}
