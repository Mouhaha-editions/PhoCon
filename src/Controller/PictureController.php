<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Form\Picture1Type;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/picture")
 */
class PictureController extends AbstractController
{
    /**
     * @Route("/", name="picture_index", methods={"GET"})
     * @param PictureRepository $pictureRepository
     * @return Response
     */
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('picture/index.html.twig', [
            'pictures' => $pictureRepository->createQueryBuilder("p")->where('p.owner = :user')
            ->setParameter('user', $this->getUser())->getQuery()->getResult(),
        ]);
    }

    /**
     * @Route("/new", name="picture_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        return $this->edit($request, new Picture());
    }

    /**
     * @Route("/{id}/edit", name="picture_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Picture $picture
     * @return Response
     */
    public function edit(Request $request, Picture $picture): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture->setOwner($this->getUser());
            $this->getDoctrine()->getManager()->persist($picture);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('picture_index');
        }

        return $this->render('picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="picture_delete")
     * @param Request $request
     * @param Picture $picture
     * @return Response
     */
    public function delete(Request $request, Picture $picture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('picture_index');
    }
}
