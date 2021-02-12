<?php

namespace App\Controller;

use App\Entity\Abonnee;
use App\Entity\User;
use App\Form\AbonneeType;
use App\Form\RegistrationFormType;
use App\Form\RegistrationFormTypeEdit;
use App\Repository\AbonneeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/abonnee")
 */
class AbonneeController extends AbstractController
{

    /**
     * @Route("/", name="abonnee_index", methods={"GET"})
     */
    public function index(UserRepository $abonneeRepository): Response
    {
        $currentuser = $this->get('security.token_storage')->getToken()->getUser();
        $users = $abonneeRepository->findAll();
                return $this->render('abonnee/index.html.twig', [

                    'titre'=>'Abonnee','soustitre'=>'Index','lien'=>$this->generateUrl('abonnee_index'),
                    'abonnees' => $abonneeRepository->findBynot(($currentuser->getEmail())),
                ]);


    }

    /**
     * @Route("/new", name="abonnee_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $abonnee = new User();
        $form = $this->createForm(RegistrationFormType::class, $abonnee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($abonnee);
            $entityManager->flush();

            return $this->redirectToRoute('abonnee_index');
        }

        return $this->render('abonnee/new.html.twig', [
            'titre'=>'Abonnee','soustitre'=>'Nouveau',
            'abonnee' => $abonnee,
            'lien'=>$this->generateUrl('abonnee_index'),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abonnee_show", methods={"GET"})
     */
    public function show(User $abonnee): Response
    {
        return $this->render('abonnee/show.html.twig', [
            'titre'=>'Abonnee','soustitre'=>'','lien'=>$this->generateUrl('abonnee_index'),
            'abonnee' => $abonnee,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="abonnee_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $abonnee): Response
    {
        $form = $this->createForm(RegistrationFormTypeEdit::class, $abonnee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $abonnee->setPassword($abonnee->getPassword());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonnee_index');
        }

        return $this->render('abonnee/edit.html.twig', [
            'titre'=>'Abonnee','soustitre'=>'Editer','lien'=>$this->generateUrl('abonnee_index'),
            'abonnee' => $abonnee,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="abonnee_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $abonnee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonnee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($abonnee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('abonnee_index');
    }
    /**
     * @Route("/suuprimer/{id}", name="abonnee_delete_2")
     */
    public function supprimer(Request $request, int $id): Response
    {
        if ($id >0) {

            $abonnee=$this->getDoctrine()->getRepository(Abonnee::class)->findOneBy(['id'=>$id]);
            $em=$this->getDoctrine()->getManager();
            $em->remove($abonnee);
            $em->flush();}
            return $this->redirectToRoute('abonnee_index');

    }

}
