<?php

namespace App\Controller\Location;

use App\Entity\Location\City;
use App\Form\Location\CityType;
use App\Repository\Location\CityRepository;
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
     * @param CityRepository $repo
     * @param Request $request
     * @return Response
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
     * @Route("/search-one-city", name="search_one_city", defaults={"_format"="json"}, methods={"GET"})
     * @param CityRepository $repo
     * @param Request $request
     * @return Response
     */
    public function searchOneAction(CityRepository $repo, Request $request): Response
    {
        $qs = $request->query->get('q', $request->query->get('term', ''));
        $citys = $repo->findOneLike($qs);


        return $this->render('user/Profile/searchOne.json.twig', ['citys' => $citys]);
    }

    /**
     * @Route("/city-pine/", name="city_pine", methods={"POST"}, options={"expose"=true})
     * @param CityRepository $repo
     * @return Response
     */
    public function getCityPine(CityRepository $repo): Response
    {

        if(isset($_POST['id'], $_POST['type'])){
            if (null === $city = $repo->find($_POST['id'])) {
                throw $this->createNotFoundException();
            }
            return $this->json([$city->getGpsLat(),$city->getGpsLng(),$_POST['type']]);
        }
        return $this->json([0,0,'unknown']);
    }




    /**
     * @Route("/", name="city_index", methods={"GET"})
     */
    public function index(CityRepository $citiesRepository): Response
    {
        return $this->render('Location/city/index.html.twig', ['cities' => $citiesRepository->findAll()]);
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

        return $this->render('Location/city/new.html.twig', [
            'city' => $city,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="city_show", methods={"GET"})
     */
    public function show(City $city): Response
    {
        return $this->render('Location/city/show.html.twig', ['city' => $city]);
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

        return $this->render('Location/city/driver_edit.html.twig', [
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
