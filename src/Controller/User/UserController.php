<?php

namespace App\Controller\User;

use App\Entity\Driver;
use App\Entity\User;
use App\Entity\Location\City;
use App\Form\User\AutoAreaType;
use App\Form\Location\CityType;
use App\Form\User\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }


    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(AutoAreaType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index', ['id' => $user->getId()]);
        }

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $this->editUserData($user);

            $deals = $user->getDeals();
            foreach ($deals as $deal){
                $driverRequests = $deal->getDriverRequests();
                foreach ($driverRequests as $driverRequest){
                    $entityManager->remove($driverRequest);
                }
                $favorites = $deal->getFavorites();
                foreach ($favorites as $favorite){
                    $entityManager->remove($favorite);
                }
                $entityManager->remove($deal);
            }

            $ads = $user->getAds();
            foreach ($ads as $ad){
                $favorites = $ad->getFavorites();
                foreach ($favorites as $favorite){
                    $entityManager->remove($favorite);
                }
                $entityManager->remove($ad);
            }

            $hostingRequests = $user->getHostingRequests();
            foreach ($hostingRequests as $hostingRequest){
                $entityManager->remove($hostingRequest);
            }

            $joinMeetupRequests = $user->getJoinRequests();
            foreach ($joinMeetupRequests as $joinRequest){
                $entityManager->remove($joinRequest);
            }

            $meetups = $user->getMeetups();
            foreach ($meetups as $meetup) {
                $joinRequests = $meetup->getJoinRequests();
                foreach ($joinRequests as $joinRequest) {
                    $entityManager->remove($joinRequest);
                }

                $waitLists = $meetup->getWaitlists();
                foreach ($waitLists as $waitList) {
                    $meetup->removeWaitlist($waitList);
                }

                $participants = $meetup->getParticipants();

                foreach ($participants as $participant) {
                    $meetup->removeParticipant($participant);
                }

                $comments = $meetup->getComments();
                foreach ($comments as $comment) {
                    $entityManager->remove($comment);
                }

                $favorites = $meetup->getFavorites();
                foreach ($favorites as $favorite) {
                    $entityManager->remove($favorite);
                }

                $entityManager->remove($meetup);
            }
            if ($user->getCarpool()){
                $voyages = $user->getCarpool()->getVoyages();
                $parentVoyages = [];
                foreach ($voyages as $voyage){
                    if(!$voyage->getParent()){
                        if(! in_array($voyage,$parentVoyages,true)){
                            $parentVoyages[] = $voyage;
                        }
                    }
                }
                if(!empty($parentVoyages)){
                    foreach ($parentVoyages as $voyage){
                        $children = $voyage->getChildren()->toArray();
                        $passengers = [];
                        foreach ( $children as $child){
                            foreach ($child->getPassenger()->toArray() as $passenger){
                                if(!in_array($passenger,$passengers,true)){
                                    $passengers[] = $passenger;
                                }
                            }
                        }
                        foreach ($voyage->getPassenger()->toArray() as $passenger){
                            if(!in_array($passenger,$passengers,true)){
                                $passengers[] = $passenger;
                            }
                        }

                        foreach ($passengers as $passenger){
                            $voyage->removePassenger($passenger);
                        }

                        $stations = $voyage->getStations()->toArray();
                        foreach ($stations as $station){
                            $entityManager->remove($station);
                        }

                        $voyageRequests = $voyage->getAllVoyageRequests();
                        foreach ($voyageRequests as $vRequest){
                            $entityManager->remove($vRequest);
                        }
                        $parentFavorites = $voyage->getFavorites();
                        foreach ($parentFavorites as $oneFavorite){
                            $entityManager->remove($oneFavorite);
                        }
                        foreach ( $children as $child){
                            foreach ($child->getFavorites() as $oneFavorite){
                                $entityManager->remove($oneFavorite);
                            }
                        }

                        foreach ($children as $child){
                            $entityManager->remove($child);
                        }
                        $entityManager->remove($voyage);
                    }
                }
                $carpool = $user->getCarpool();
                $carpool->setAnimal(false);
                $carpool->setBaby(false);
                $carpool->setBankCard(false);
                $carpool->setBag(false);
                $carpool->setConversation(false);
                $carpool->setMusic(false);
                $carpool->setPoint(0);
                $carpool->setCarImage(null);
                $carpool->setNumberOfPassengers(0);
                $carpool->setCarBrand(null);
                $carpool->setCarColor(null);
                $entityManager->persist($carpool);

            }

            if($user->getDriver()){
                $driver = $user->getDriver();
                $driver->setCarColor('');
                $driver->setCarBrand('');
                $driver->setCarColor('');
                $driver->setCarImage('');
                $driver->setMaxDistance(0);
                $driver->setPoint(0);
                $driver->setActive(false);
                $driver->setGpsLat(0);
                $driver->setGpsLng(0);
                $driver->setFeedback(null);
                $entityManager->persist($driver);

            }
            if($user->getHosting()){
                $hosting = $user->getHosting();
                $hosting->setActive(false);
                $hosting->setPoint(0);
                $hosting->setHostingFor('');
                $hosting->setAboutMe('');
                $hosting->setSex('');
                $hosting->setAge(0);
                $hosting->setLanguages([]);
                $hosting->setImage('');
                $hosting->setNumberOfDays(0);
                $hosting->setNumberOfPersons(0);
                $hosting->setAnimal(false);
                $hosting->setChild(false);
                $hosting->setHandicapped(false);
                $hosting->setFood(false);
                $hosting->setConversation(false);
                $hosting->setCityTour(false);
                $hosting->setVideoGame(false);
                $hosting->setMovie(false);
                $hosting->setTelevision(false);
                $hosting->setMusic(false);
                $entityManager->persist($hosting);

            }

            $entityManager->flush();
            $this->addFlash(
                'success',
                'Your account was successfully deleted!');
        }
        if($this->getUser()->isAdmin()){
            return $this->redirectToRoute('user_index');
        }
        return $this->redirectToRoute('security_logout');

    }

    private function editUserData(User $user): void
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user->setDeleted(true);
        $user->setUsername((string) $user->getId());
        $newEmail = (string) $user->getId().'@godeal.godeal';
        $user->setEmail($newEmail);
        $user->setEmailCanonical($newEmail);
        $user->setEnabled(false);
        $user->setFirstname('Godeal user');
        $user->setLastname('Deleted');
        $user->setMaxDistance(1);
        $user->setPoint(0);
        $user->setPhoneNumber(null);
        $user->setGender(null);
        $user->setBirthday(null);
        $user->setProfileImage(null);

        $entityManager->persist($user);
        $entityManager->flush();

    }

}
