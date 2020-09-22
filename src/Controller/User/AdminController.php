<?php

namespace App\Controller\User;

use App\Entity\Ads\Category;
use App\Entity\Ads\Specification;
use App\Entity\Driver;
use App\Entity\Visit;
use App\Form\Ads\CategorySpecificationType;
use App\Form\Ads\CategoryType;
use App\Form\Ads\SpecificationType;
use App\Form\Category\FirstCategoryType;
use App\Form\Category\SecondCategoryType;
use App\Repository\Ads\CategoryRepository;
use App\Repository\Cafe\CafeRepository;
use App\Repository\Hosting\HostingRequestRepository;
use App\Repository\Meetup\MeetupRepository;
use App\Repository\Carpool\VoyageRepository;
use App\Entity\User;
use App\Form\User\UserType;
use App\Repository\Ads\AdRepository;
use App\Repository\Carpool\CarpoolRepository;
use App\Repository\Deal\DealRepository;
use App\Repository\Deal\DoneDealRepository;
use App\Repository\DriverRepository;
use App\Repository\Hosting\HostingRepository;
use App\Repository\UserRepository;
use App\Repository\VisitRepository;
use DateInterval;
use DatePeriod;
use Knp\Component\Pager\PaginatorInterface;
use Swift_Attachment;
use Swift_Image;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Contracts\Translation\TranslatorInterface;


/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{
    private $userRepo;
    private $driverRepo;
    private $hostingRepo;
    private $carpoolRepo;
    private $adRepo;
    private $dealRepo;
    private $doneDealRepo;
    private $voyageRepo;
    private $meetupRepo;
    private $encoder;
    private $cafeRepo;
    private $hostingRequestRepo;
    private $categoryRepo;
    private $visitRepo;


    public function __construct(
        UserRepository $userRepository,
        DriverRepository $driverRepository,
        HostingRepository $hostingRepository,
        CarpoolRepository $carpoolRepository,
        AdRepository $adRepository,
        DealRepository $dealRepository,
        DoneDealRepository $doneDealRepository,
        VoyageRepository $voyageRepository,
        MeetupRepository $meetupRepository,
        UserPasswordEncoderInterface $encoder,
        CafeRepository $cafeRepository,
        HostingRequestRepository $hostingRequestRepo,
        CategoryRepository $categoryRepository,
        VisitRepository $visitRepository

    )
    {
        $this->userRepo=$userRepository;
        $this->driverRepo=$driverRepository;
        $this->hostingRepo=$hostingRepository;
        $this->carpoolRepo=$carpoolRepository;
        $this->adRepo=$adRepository;
        $this->dealRepo=$dealRepository;
        $this->doneDealRepo=$doneDealRepository;
        $this->voyageRepo=$voyageRepository;
        $this->meetupRepo=$meetupRepository;
        $this->encoder = $encoder;
        $this->cafeRepo = $cafeRepository;
        $this->hostingRequestRepo = $hostingRequestRepo;
        $this->categoryRepo = $categoryRepository;
        $this->visitRepo = $visitRepository;

    }

    /**
     * @Route("/", name="admin_index", methods={"GET"})
     * @return Response
     */
    public function index(): Response
    {

        $data = [];
        $data['userCount']= $this->userRepo->userCount();
        $data['activeUsers']= $this->userRepo->activeUserCount();
        $data['inactiveUsers']= $this->userRepo->inactiveUserCount();
        $data['driverCount']= $this->driverRepo->driverCount();
        $data['hostingCount']= $this->hostingRepo->hostingCount();
        $data['carpoolCount']= $this->carpoolRepo->carpoolCount();
        $data['adCount']= $this->adRepo->adCount();
        $data['offerCount']= $this->adRepo->adCount('Offer');
        $data['demandCount']= $this->adRepo->adCount('Demand');
        $data['sDealCount']= $this->dealRepo->dealCount();
        $data['dDealCount']= $this->doneDealRepo->doneDealCount();
        $data['voyageCount']= $this->voyageRepo->voyageCount();
        $data['mainVoyageCount']= $this->voyageRepo->voyageCount('main');
        $data['subVoyageCount']= $this->voyageRepo->voyageCount('sub');
        $data['meetupCount']= $this->meetupRepo->meetupCount();
        $data['activeMeetupCount']= $this->meetupRepo->meetupCount('active');
        $data['finishMeetupCount']= $this->meetupRepo->meetupCount('finish');

        return $this->render('admin/view/admin.html.twig', ['data'=>$data]);
    }

    /**
     * @Route("/users", name="user_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function user_index(Request $request, PaginatorInterface $paginator): Response
    {
        $result= $this->userRepo->findAll();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        return $this->render('admin/view/users/users.html.twig', ['users' => $results]);
    }

    /**
     * @Route("/newuser", name="user_new", methods={"POST"})
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @param TranslatorInterface $translator
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, \Swift_Mailer $mailer, TranslatorInterface $translator): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->remove('username');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();


            $email = $user->getEmail();
            $lastname = random_int(1001,9999);
            $user->setUsername($email);
            $user->setLastname((string)$lastname);
            $plainPassword = $user->getPlainPassword();
            $encoded = $this->encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
            $user->setVille($user->getCity()->getName());
            $user->setPostalCode($user->getCity()->getZipCode());
            $user->setMapY($user->getCity()->getGpsLat());
            $user->setMapX($user->getCity()->getGpsLng());
            if($form->get('admin')->getData()){
                $user->setRoles(['ROLE_ADMIN']);
            }
            $entityManager->persist($user);
            $entityManager->flush();

            $subject = $translator->trans('Your DispoDeal Account has been created');
            $message = (new \Swift_Message())
                ->setContentType('text/html')
                ->setSubject($subject)
                /*change to prod email*/
                ->setFrom('info@dispodeal.fr')
                /*send to $email*/
                ->setTo('ziadoof@gmail.com');
            $img = $message->embed(\Swift_Image::fromPath('assets/images/logo/face.png'));
            $message->setBody($this->renderView('user/Mail/new_user_mail.html.twig', ['user' => $user, 'img' => $img, 'pass'=>$plainPassword]));
            $mailer->send($message);

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/view/users/new_user.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ads", name="admin_ads", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_ads(Request $request, PaginatorInterface $paginator): Response
    {
        $result = $this->adRepo->findAll();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        $data['offerCount']= $this->adRepo->adCount('Offer');
        $data['demandCount']= $this->adRepo->adCount('Demand');
        return $this->render('admin/view/ads.html.twig', ['ads' => $results,'data'=>$data]);
    }

    /**
     * @Route("/deals", name="admin_deals", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_deals(Request $request, PaginatorInterface $paginator): Response
    {

        $result = $this->dealRepo->findAll();
        $doneDeals = $this->doneDealRepo->findAll();
        foreach ($doneDeals as $doneDeal){
            $result[] = $doneDeal;
        }
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        $data['sDealCount']= $this->dealRepo->dealCount();
        $data['dDealCount']= $this->doneDealRepo->doneDealCount();
        return $this->render('admin/view/deals.html.twig', ['deals' => $results,'data'=>$data]);
    }

    /**
     * @Route("/cafes", name="admin_cafe", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_cafe(Request $request, PaginatorInterface $paginator): Response
    {

        $result = $this->cafeRepo->findAll();

        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        return $this->render('admin/view/cafes.html.twig', ['cafes' => $results]);
    }

    /**
     * @Route("/hosting", name="admin_hosting", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_hosting(Request $request, PaginatorInterface $paginator): Response
    {

        $result = $this->hostingRequestRepo->findAll();

        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        $data['doneHosting']= $this->hostingRequestRepo->doneHostingCount();
        $data['hosting']= $this->hostingRequestRepo->noDonsHostingCount();
        return $this->render('admin/view/hostings.html.twig', ['hostings' => $results,'data'=>$data]);
    }

    /**
     * @Route("/meetup", name="admin_meetup", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_meetup(Request $request, PaginatorInterface $paginator): Response
    {

        $result = $this->meetupRepo->findAll();

        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        $data['activeMeetupCount']= $this->meetupRepo->meetupCount('active');
        $data['finishMeetupCount']= $this->meetupRepo->meetupCount('finish');
        return $this->render('admin/view/meetup.html.twig', ['meetups' => $results, 'data'=>$data]);
    }

    /**
     * @Route("/voyages", name="admin_voyage", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function admin_voyage(Request $request, PaginatorInterface $paginator): Response
    {

        $result = $this->voyageRepo->findAll();

        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        $data['mainVoyageCount']= $this->voyageRepo->voyageCount('main');
        $data['subVoyageCount']= $this->voyageRepo->voyageCount('sub');
        return $this->render('admin/view/voyage.html.twig', ['voyages' => $results,'data'=>$data]);
    }

    /**
     * @Route("/category", name="admin_category", methods={"GET","POST"})
     * @return Response
     */
    public function admin_category(): Response
    {

        $results = $this->categoryRepo->findAllOfferCategory();
        $data['parentCount']= $this->categoryRepo->categoryCount();
        $data['childCount']= $this->categoryRepo->categoryCount('child');

        if (!empty($_POST['edit_category_id']) && $_POST['edit_category_id'] > 0) {

            $editCategoryId = $_POST['edit_category_id'];
            $category = $this->categoryRepo->findCategoryById($editCategoryId);

            echo '<script type="text/javascript">  setTimeout(function(){ $(\'#admin_edit_category\').modal(\'show\'); }, 2000);  </script>';

            return $this->render('admin/view/category.html.twig', ['categorys' => $results,'data'=>$data, 'categoryId'=>$category]);
        }

        return $this->render('admin/view/category.html.twig', ['categorys' => $results,'data'=>$data]);
    }

    /**
     * @Route("/category/{id}/edit", name="category_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function edit_category(Request $request, Category $category): Response
    {
        $categoryRelated = $this->categoryRepo->findCategoryRelated($category);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            /*make edit for 4 category in name and parent*/
            if ($category->getParent()=== null){
                foreach ($categoryRelated as $oneCategory){
                    $oneCategory->setName($category->getName());
                    $em->persist($oneCategory);
                }
            }
            else{
                foreach ($categoryRelated as $oneCategory){
                    $oneCategory->setName($category->getName());
                    $parent= $this->categoryRepo->findParentCategoryByName($category->getParent()->getName(),$oneCategory->getType());
                    $oneCategory->setParent($parent);
                    $em->persist($oneCategory);
                }
            }

            $em->flush();
            return $this->redirectToRoute('admin_category');
        }

        return $this->render('Ads/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new_category/{type}", name="category_new", methods={"GET","POST"})
     * @param Request $request
     * @param string $type
     * @return Response
     */
    public function new_category(Request $request, string $type ): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $session = new Session();

        $category = new Category();
        $form = $this->createForm(FirstCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           if($form->get('isParent')->getData()){

               $serializedCategory = $category->serializ();
               $session->set('category', $serializedCategory);
               return $this->redirectToRoute('category_new',['type'=>'second']);

           }
            $fourCategory = $this->createFourParentCategory($category);
           foreach ($fourCategory as $oneCategory){
               $entityManager->persist($oneCategory);
           }
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your category was successfully added!');
            return $this->redirectToRoute('admin_category');
        }


        if ($type === 'second'){

            $serializedCategory = $session->get('category');
            $normalizedCategory = new Category();
            $normalizedCategory->setName($serializedCategory['name']);

            $secondForm = $this->createForm(SecondCategoryType::class, $normalizedCategory);
            $secondForm->handleRequest($request);
            if ($secondForm->isSubmitted() && $secondForm->isValid()) {
                $serializedCategoryWithParent = $normalizedCategory->serializ();
                $session->set('category', $serializedCategoryWithParent);
                return $this->redirectToRoute('category_new',['type'=>'offerSpecification']);
            }
            return $this->render('admin/view/category/second_category.html.twig', [
                'category' => $normalizedCategory,
                'form' => $secondForm->createView(),
            ]);

        }

        if ($type === 'offerSpecification'){

            $categorySession = $session->get('category');
            $category = $this->sessionToCategory($categorySession);

            $offerForm = $this->createForm(CategorySpecificationType::class, $category);
            $offerForm->handleRequest($request);

            if ($offerForm->isSubmitted() && $offerForm->isValid()) {
                $offerSpecifications = $offerForm->get('specifications')->getData();
                $session->set('offerSpecifications', $offerSpecifications);
                return $this->redirectToRoute('category_new',['type'=>'demandSpecification']);
            }
            return $this->render('admin/view/category/offer_specification.html.twig', [
                'category' => $categorySession,
                'form' => $offerForm->createView(),
            ]);

        }
        if ($type === 'demandSpecification'){

            $categorySession = $session->get('category');
            $category = $this->sessionToCategory($categorySession);
            $offerSpecifications = $session->get('offerSpecifications');

            $demandForm = $this->createForm(CategorySpecificationType::class, $category);
            $demandForm->handleRequest($request);

            if ($demandForm->isSubmitted() && $demandForm->isValid()) {
                $demandSpecifications = $demandForm->get('specifications')->getData();
                $session->set('demandSpecifications', $demandSpecifications);
                return $this->redirectToRoute('category_new',['type'=>'searchOfferSpecification']);
            }
            return $this->render('admin/view/category/demand_specification.html.twig', [
                'category' => $categorySession,
                'form' => $demandForm->createView(),
                'offerSpecifications'=> $offerSpecifications
            ]);

        }

        if ($type === 'searchOfferSpecification'){
            $categorySession = $session->get('category');
            $category = $this->sessionToCategory($categorySession);
            $offerSpecifications = $session->get('offerSpecifications');
            $demandSpecifications = $session->get('demandSpecifications');


            $searchOfferForm = $this->createForm(CategorySpecificationType::class, $category);
            $searchOfferForm->handleRequest($request);

            if ($searchOfferForm->isSubmitted() && $searchOfferForm->isValid()) {
                $searchOfferSpecifications = $searchOfferForm->get('specifications')->getData();
                $session->set('searchOfferSpecifications', $searchOfferSpecifications);
                return $this->redirectToRoute('category_new',['type'=>'searchDemandSpecification']);
            }
            return $this->render('admin/view/category/searchOffer_specification.html.twig', [
                'category' => $categorySession,
                'form' => $searchOfferForm->createView(),
                'demandSpecifications'=>$demandSpecifications,
                'offerSpecifications'=> $offerSpecifications
            ]);
        }

        if ($type === 'searchDemandSpecification'){
            $categorySession = $session->get('category');
            $category = $this->sessionToCategory($categorySession);
            $offerSpecifications = $session->get('offerSpecifications');
            $demandSpecifications = $session->get('demandSpecifications');
            $searchOfferSpecifications = $session->get('searchOfferSpecifications');

            $searchDemandForm = $this->createForm(CategorySpecificationType::class, $category);
            $searchDemandForm->handleRequest($request);

            if ($searchDemandForm->isSubmitted() && $searchDemandForm->isValid()) {
                $offerCategory = $this->sessionToCategory($categorySession);
                $parentOfferCategory = $this->categoryRepo->findParentCategoryByName($categorySession['parent'],'Offer');
                $offerCategory->setType('Offer');
                $offerCategory->setParent($parentOfferCategory);
                $entityManager->persist($offerCategory);


                $demandCategory = $this->sessionToCategory($categorySession);
                $demandCategory->setType('Demand');
                $parentDemandCategory = $this->categoryRepo->findParentCategoryByName($categorySession['parent'],'Demand');
                $demandCategory->setParent($parentDemandCategory);
                $entityManager->persist($demandCategory);


                $searchOfferCategory = $this->sessionToCategory($categorySession);
                $searchOfferCategory->setType('SearchOffer');
                $parentSearchOfferCategory = $this->categoryRepo->findParentCategoryByName($categorySession['parent'],'SearchOffer');
                $searchOfferCategory->setParent($parentSearchOfferCategory);
                $entityManager->persist($searchOfferCategory);


                $searchDemandCategory = $this->sessionToCategory($categorySession);
                $searchDemandCategory->setType('SearchDemand');
                $parentSearchDemandCategory = $this->categoryRepo->findParentCategoryByName($categorySession['parent'],'SearchDemand');
                $searchDemandCategory->setParent($parentSearchDemandCategory);
                $entityManager->persist($searchDemandCategory);


                $offerSpecifications = $session->get('offerSpecifications');
                $demandSpecifications = $session->get('demandSpecifications');
                $searchOfferSpecifications = $session->get('searchOfferSpecifications');
                $searchDemandSpecifications = $searchDemandForm->get('specifications')->getData();


                if($offerSpecifications){
                    foreach ($offerSpecifications as $one){
                        $specification = $this->createSpecification($one);
                        $specification->setCategory($offerCategory);
                        $entityManager->persist($specification);

                    }
                }
                if ($demandSpecifications){
                    foreach ($demandSpecifications as $one){
                        $specification = $this->createSpecification($one);
                        $specification->setCategory($demandCategory);
                        $entityManager->persist($specification);
                    }
                }
                if($searchOfferSpecifications){
                    foreach ($searchOfferSpecifications as $one){
                        $specification = $this->createSpecification($one);
                        $specification->setCategory($searchOfferCategory);
                        $entityManager->persist($specification);
                    }
                }
                if ($searchDemandSpecifications){
                    foreach ($searchDemandSpecifications as $one){
                        $specification = $this->createSpecification($one);
                        $specification->setCategory($searchDemandCategory);
                        $entityManager->persist($specification);
                    }
                }
                $entityManager->flush();
                $this->addFlash(
                    'success',
                    'Your category has bin saved ..!'
                );
                return $this->redirectToRoute('admin_category');
            }
            return $this->render('admin/view/category/searchDemand_specification.html.twig', [
                'category' => $categorySession,
                'form' => $searchDemandForm->createView(),
                'demandSpecifications'=>$demandSpecifications,
                'offerSpecifications'=> $offerSpecifications,
                'searchOfferSpecifications'=> $searchOfferSpecifications
            ]);
        }

        return $this->render('admin/view/category/first_category.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    public function createSpecification (array $data): Specification
    {
        $specification = new Specification();
        $specification->setName($data['name']);
        $lowerName = strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $data['name']));
        $label = ucwords($lowerName) ;
        $specification->setLabel($label);
        $specification->setType($data['type']);
        if($data['type']=== 'ChoiceType'){
            $typeOfChoice =  $data['typeOfChoice'];
            $specification->setTypeOfChoice($typeOfChoice);
            if ($typeOfChoice === 'SequentialNumericOptions'){
                $specification->setMinOption($data['minOption']);
                $specification->setMaxOption($data['maxOption']);
            }
            if ($typeOfChoice === 'TextOptions'){
                $text = $data['textOptions'];
                $textOptions = [];
                $keyValue = ['experience','classEnergie', 'ges', 'paperSize', 'levelOfStudent','generalSituation','minCapacity','numberOfPersson','capacity'];

                if(in_array($data['name'],$keyValue,true)){
                    $options = explode(', ', $text);
                    foreach ($options as $one){
                        $choice = explode('. ', $one);
                        $textOptions[ucwords($choice[0])]=ucwords($choice[1]);
                    }
                }
                else{
                    $toArray= explode(', ', $text);
                    foreach ($toArray as $one){
                        $textOptions[] =  ucwords($one);
                    }
                }
                $specification->setTextOptions($textOptions);
            }
            if ($typeOfChoice === 'NumericOptions'){
                $numeric = $data['numericOptions'];
                $numericOptions = explode(', ', $numeric);
                $specification->setTextOptions($numericOptions);
            }
        }
        return $specification;

    }

    public function sessionToCategory(array $session): Category
    {
        $category = new Category();
        $category->setName($session['name']);
        $parent = $this->categoryRepo->findCategoryByName($session['parent'],'Offer',null);
        $category->setParent($parent);
        return $category;
    }

    public function createFourParentCategory(Category $category): array
    {
        $offerCategory = new Category();
        $offerCategory->setName(ucwords($category->getName()));
        $offerCategory->setType('Offer');
        $offerCategory->setParent(null);

        $demandCategory = new Category();
        $demandCategory->setName(ucwords($category->getName()));
        $demandCategory->setType('Demand');
        $demandCategory->setParent(null);

        $searchOfferCategory = new Category();
        $searchOfferCategory->setName(ucwords($category->getName()));
        $searchOfferCategory->setType('SearchOffer');
        $searchOfferCategory->setParent(null);

        $searchDemandCategory = new Category();
        $searchDemandCategory->setName(ucwords($category->getName()));
        $searchDemandCategory->setType('SearchDemand');
        $searchDemandCategory->setParent(null);

        return[$offerCategory,$demandCategory,$searchOfferCategory,$searchDemandCategory];
    }

    /**
     * @Route("/admin/carpools", name="carpool_index", methods={"GET"})
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function carpool_index(Request $request, PaginatorInterface $paginator): Response
    {
        $result= $this->carpoolRepo->findAll();
        $results = $paginator->paginate(
        // Doctrine Query, not results
            $result,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            50
        );
        return $this->render('admin/view/users/carpoolUsers.html.twig', [
            'carpools' => $results,
        ]);
    }


    /**
     * @Route("/users/map", name="users_map", methods={"POST"}, options={"expose"=true})
     * @param Request $request
     * @return Response
     */
    public function users_map(Request $request, UserRepository $repository){
        $usersData = $repository->findUserData();
        $locations = [];
        $data = [];
        foreach ($usersData as $user){
            if ($user['mapX']!== null){
                $locations[]= [$user['mapY'],$user['mapX']];
                $data[]= [
                    'firstname'=>$user['firstname'],
                    'lastname'=>$user['lastname'],
                    'id'=>$user['id'],
                    'ville'=>$user['ville'],
                    'lastLogin'=>$user['lastLogin'],
                    'lastActivityAt'=>$user['lastActivityAt'],
                    'enabled'=>$user['enabled'],
                    'image'=>$user['profileImage'],
                ];
            }
        }
        $response = ['location'=>$locations, 'data'=>$data];

        return new JsonResponse($response);
    }



    /**
     * @Route("/visit", name="visit_index", methods={"GET","POST"})
     */
    public function visit_index(){
        $date = new \DateTime('now');
        /*$date->modify('+1 day');*/
        $day = $this->visitRepo->dayVisitCount($date);
        $month = $this->visitRepo->monthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        return $this->render('admin/view/visits/index.html.twig', [
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$date
        ]);
    }

    /**
     * @Route("/day", name="visit_day", methods={"GET","POST"})
     * @param null $day
     * @return Response
     */
    public function visit_day(){
        $date = new \DateTime('now');

        /*$date->modify('+1 day');*/
        $visits = $this->visitRepo->findAllByDay($date);

        $day = $this->visitRepo->dayVisitCount($date);
        $month = $this->visitRepo->monthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        return $this->render('admin/view/visits/day_visits.html.twig', [
            'visits'=>$visits,
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$date
        ]);
    }

    /**
     * @Route("/showday/{day}", name="show_day", methods={"GET","POST"})
     * @param DateTime $day
     * @return Response
     */
    public function show_day(string $day){

        $date = new \DateTime($day." 00:00:00");
        /*$date->modify('+1 day');*/
        $visits = $this->visitRepo->findAllByDay($date);

        $day = $this->visitRepo->dayVisitCount($date);
        $month = $this->visitRepo->monthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        return $this->render('admin/view/visits/day_visits.html.twig', [
            'visits'=>$visits,
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$date
        ]);
    }

    /**
     * @Route("/month", name="visit_month", methods={"GET","POST"})
     */
    public function visit_month(){
        $date = new \DateTime('now');
        /*$date->modify('+1 day');*/
        $visits = [];
        $from = new \DateTime($date->format("Y-m")."-1 00:00:00");
        $to   = new \DateTime($date->format("Y-m-d")." 23:59:59");

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($from, $interval, $to);
        foreach ($period as $one) {
            $oneDay ['date']= $one;
            $oneDay ['nOfVisit']= $this->visitRepo->dayVisitCount($one);
            $nOfPages = 0;
            $allDayVisits = $this->visitRepo->findAllByDay($one);
            foreach ($allDayVisits as $visit){
                $nOfPages += $visit->getPagesVisited();
            }
            $oneDay ['nOfPages']= $nOfPages;

            $visits[]=$oneDay;
        }

        $day = $this->visitRepo->dayVisitCount($date);
        $month = $this->visitRepo->monthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        return $this->render('admin/view/visits/multi_visits.html.twig', [
            'visits'=>$visits,
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$date
        ]);
    }

    /**
     * @Route("/showmonth/{month}", name="show_month", methods={"GET","POST"})
     * @param string $month
     * @return Response
     * @throws \Exception
     */
    public function show_month(string $month){

        $date = new \DateTime($month."-1 00:00:00");
        $visits = [];
        $from = new \DateTime($date->format("Y-m")."-1 00:00:00");
        $to   = new \DateTime($date->format("Y-m")."-31 23:59:59");

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($from, $interval, $to);
        foreach ($period as $one) {
            $oneDay ['date']= $one;
            $oneDay ['nOfVisit']= $this->visitRepo->dayVisitCount($one);
            $nOfPages = 0;
            $allDayVisits = $this->visitRepo->findAllByDay($one);
            foreach ($allDayVisits as $visit){
                $nOfPages += $visit->getPagesVisited();
            }
            $oneDay ['nOfPages']= $nOfPages;

            $visits[]=$oneDay;
        }
        $day = $this->visitRepo->dayVisitCount(new \DateTime('now'));
        $month = $this->visitRepo->allMonthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        $lastDayOfMonth = null;
        $now = new \DateTime('now');
        if($date->format('m-y')=== $now->format('m-y')){
            $lastDayOfMonth = $now;
        }
        else{
            $lastDayOfMonth = $date->format( 'Y-m-t' );
        }

        return $this->render('admin/view/visits/multi_visits.html.twig', [
            'visits'=>$visits,
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$lastDayOfMonth
        ]);
    }

    /**
     * @Route("/allvisit", name="visit_all", methods={"GET","POST"})
     */
    public function visit_all(){

        $firstVisit = $this->visitRepo->findFirstVisits();
        $firstDate = $firstVisit->getDate();
        $date = new \DateTime('now');
        $allVisits = [];
        $allInterval = DateInterval::createFromDateString('1 month');
        $allPeriod = new DatePeriod($firstDate, $allInterval, $date);


        foreach ($allPeriod as $oneMonth) {
            $month = [];
            $pageByMonth =0;

            $month['month'] = $oneMonth;
            $month ['vByMonth']= $this->visitRepo->monthVisitCount($oneMonth);
            $from = new \DateTime($oneMonth->format("Y-m")."-1 00:00:00");
            $to   = new \DateTime($oneMonth->format("Y-m")."-31 23:59:59");

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($from, $interval, $to);
            foreach ($period as $one) {
                $oneDay ['date']= $one;
                $oneDay ['nOfVisit']= $this->visitRepo->dayVisitCount($one);
                $nOfPages = 0;
                $allDayVisits = $this->visitRepo->findAllByDay($one);
                foreach ($allDayVisits as $visit){
                    $nOfPages += $visit->getPagesVisited();
                }
                $oneDay ['nOfPages']= $nOfPages;
                $pageByMonth += $nOfPages;
            }
            $month['pageByMonth'] = $pageByMonth;
            $allVisits[] = $month;
        }

        $day = $this->visitRepo->dayVisitCount($date);
        $month = $this->visitRepo->monthVisitCount($date);
        $all = $this->visitRepo->allVisitCount();

        return $this->render('admin/view/visits/all_visits.html.twig', [
            'visits'=>$allVisits,
            'all' => $all,
            'month' => $month,
            'day' => $day,
            'date'=>$date
        ]);
    }

}
