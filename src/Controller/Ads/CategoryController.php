<?php

namespace App\Controller\Ads;

use App\Entity\Ads\Category;
use App\Form\Ads\CategoryType;
use App\Repository\Ads\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/{id}", name="category_delete", methods={"DELETE"})
     * @param Request $request
     * @param Category $category
     * @param CategoryRepository $repository
     * @return Response
     */
    public function delete(Request $request, Category $category, CategoryRepository $repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            if ($category->getParent() !== null){
                $donedeals = $category->getDoneDeals();
                foreach ($donedeals as $doneDeal){
                    $entityManager->remove($doneDeal);
                }

                $deals = $category->getDeals();
                foreach ($deals as $deal){
                    $driverRequests =  $deal->getDriverRequests();
                    foreach ($driverRequests as $driverRequest){
                        $entityManager->remove($driverRequest);
                    }
                    $entityManager->remove($deal);
                }
                $ads = $category->getAds();
                foreach ($ads as $ad){
                    $entityManager->remove($ad);
                }
                $categoryRelateds = $repository->findCategoryRelated($category);
                foreach ($categoryRelateds as $categoryRelated){
                    $specifications = $categoryRelated->getSpecifications();
                    foreach ($specifications as $specification){
                        $entityManager->remove($specification);
                    }
                    $entityManager->remove($categoryRelated);
                }
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Your category has been deleted with all done deals and deals and driver requests and ads  and specification related!'
                );
            }
            $children = $category->getChildren();
            foreach ($children as $child){
                $donedeals = $child->getDoneDeals();
                foreach ($donedeals as $doneDeal){
                    $entityManager->remove($doneDeal);
                }

                $deals = $child->getDeals();
                foreach ($deals as $deal){
                    $driverRequests =  $deal->getDriverRequests();
                    foreach ($driverRequests as $driverRequest){
                        $entityManager->remove($driverRequest);
                    }
                    $entityManager->remove($deal);
                }
                $ads = $child->getAds();
                foreach ($ads as $ad){
                    $entityManager->remove($ad);
                }
                $categoryRelateds = $repository->findCategoryRelated($child);
                foreach ($categoryRelateds as $categoryRelated){
                    $specifications = $categoryRelated->getSpecifications();
                    foreach ($specifications as $specification){
                        $entityManager->remove($specification);
                    }
                    $entityManager->remove($categoryRelated);
                }
            }
            $categoryRelateds = $repository->findCategoryRelated($category);
            foreach ($categoryRelateds as $categoryRelated){
                $entityManager->remove($categoryRelated);
            }
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your parent category has been deleted with all his child and all done deals and deals and driver requests and ads  and specification related!'
            );
        }

        return $this->redirectToRoute('admin_category');
    }



    /**
     * @Route("/categorys", name="select_category", methods="GET|POST", options={"expose"=true})
     */
    public function subcategoryAction(Request $request)
    {
        $generalcategory_id = $request->request->get('generalcategory_id');

        $em = $this->getDoctrine()->getManager();

        $subcategory = $em->getRepository(Category::class)->findCategoryByParentId($generalcategory_id);

        return new JsonResponse($subcategory);
    }
}
