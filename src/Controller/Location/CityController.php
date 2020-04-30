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

}
