<?php

namespace App\Controller;

use App\Entity\City;
use App\Form\CityType;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/city")
 */
final class CityController extends AbstractController
{

    /**
     * @Route("/search-city", name="search_city", defaults={"_format"="json"}, methods={"GET"})
     *
     */
    public function searchAction(CityRepository $repo, Request $request): Response
    {
        $qs = $request->query->get('q', $request->query->get('term', ''));
        $citys = $repo->findLike($qs);


        return $this->render('user/Profile/search.json.twig', ['citys' => $citys]);
    }

    /**
     * @Route("/get-city/{id}", name="get_city", defaults={"_format"="json"}, methods={"GET"})
     *
     */
    public function getAction(int $id = null, CityRepository $repo): Response
    {
        if (null === $city = $repo->find($id)) {
            throw $this->createNotFoundException();
        }

        return $this->json($city->getName());
    }




    /**
     * @Route("/", name="city_index", methods={"GET"})
     */
    public function index(CityRepository $citiesRepository): Response
    {
        return $this->render('city/index.html.twig', ['cities' => $citiesRepository->findAll()]);
    }

    /**
     * @Route("/new", name="city_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();

            return $this->redirectToRoute('city_index');
        }

        return $this->render('city/new.html.twig', [
            'city' => $city,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="city_show", methods={"GET"})
     */
    public function show(City $city): Response
    {
        return $this->render('city/show.html.twig', ['city' => $city]);
    }

    /**
     * @Route("/{id}/edit", name="city_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, City $city): Response
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('city_index', ['id' => $city->getId()]);
        }

        return $this->render('city/edit.html.twig', [
            'city' => $city,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="city_delete", methods={"DELETE"})
     */
    public function delete(Request $request, City $city): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($city);
            $entityManager->flush();
        }

        return $this->redirectToRoute('city_index');
    }
}
