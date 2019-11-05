<?php

namespace App\Controller;

use App\Entity\Contest;
use App\Form\ContestType;
use App\Repository\ContestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContestController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/nouveau/concours", name="contest_new")
     */
    public function new(Request $request): Response
    {
        return $this->edit($request, new Contest());
    }

    /**
     * @Route("/modifier/concours/{id}", name="contest_edit")
     */
    public function edit(Request $request, Contest $contest): Response
    {
        $form = $this->createForm(ContestType::class, $contest);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() ){
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('contest/edit.html.twig',[
            'contest'=>$contest,
            'form'=>$form->createView(),
        ]);
    }


    /**
     * @Route("/contest-{id}.json", name="contest_json")
     * @param Request $request
     * @param ContestRepository $contest
     * @return Response
     */

    public function jsonContest(Request $request, Contest $contest): Response
    {
        return new JsonResponse($contest->serialize());
    }

    /**
     * @Route("/opened-contests.json", name="opened_contests_json")
     * @param Request $request
     * @param ContestRepository $contestRepository
     * @return Response
     */
    public function jsonOpenedContests(Request $request, ContestRepository $contestRepository): Response
    {
        $contests = $contestRepository->createQueryBuilder('c')
            ->getQuery()->getResult();

        return new JsonResponse(array_map(function(Contest $contest){ return ['id'=>$contest->getId()];},$contests));
    }
}