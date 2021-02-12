<?php

namespace App\Controller;

use App\Entity\Emprunte;
use App\Entity\Livre;
use App\Entity\User;
use App\Form\EmprunteType;
use App\Repository\EmprunteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * @Route("/emprunte")
 */
class EmprunteController extends AbstractController
{
    /**
     * @Route("/", name="emprunte_index", methods={"GET"})
     */
    public function index(EmprunteRepository $emprunteRepository): Response
    {

        $currentuser = $this->get('security.token_storage')->getToken()->getUser();


        if($currentuser->getRoles()== ["ROLE_ADMIN"]) {
            return $this->render('emprunte/index.html.twig', [
                'titre' => 'Emprunte', 'soustitre' => 'Index', 'lien' => $this->generateUrl('emprunte_index'),
                'empruntes' => $emprunteRepository->findAll(),
            ]);
        }
        return $this->render('emprunte/index.html.twig', [
            'titre' => 'Emprunte', 'soustitre' => 'Index', 'lien' => $this->generateUrl('emprunte_index'),
            'empruntes' => $emprunteRepository->findBy(['user' => $currentuser->getId()]),
        ]);
    }

    /**
     * @Route("/new", name="emprunte_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $verifier = true;
        $emprunte = new Emprunte();
        $form = $this->createForm(EmprunteType::class, $emprunte);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user1 = $this->get('security.token_storage')->getToken()->getUser();
            $emprunte->setUser($user1);
            $repLivre = $this->getDoctrine()->getRepository(Livre::class);
            $livres = $repLivre->findAll();
            $livreE = $emprunte->getLivres();
            foreach ($livres as $livre) {
                foreach ($livreE as $le) {
                    if ($livre == $le) {
                        if ($livre->getNbrexemplaires() == 1) {
                            $this->addFlash('info', 'le nombre exemplaires du livre: '. $livre->getTitre().' egale à 1');
                            $verifier = false;
                        }
                    }
                }

            }
            if ($verifier == true) {
                foreach ($livres as $livre) {
                    foreach ($livreE as $le) {
                        if ($livre == $le) {
                            if ($livre->getNbrexemplaires() != 1) {
                                $livre->setNbrexemplaires($livre->getNbrexemplaires() - 1);
                                $emprunte->setEtat("Non Retourné");
                                $this->getDoctrine()->getManager()->flush();
                            }

                            $entityManager = $this->getDoctrine()->getManager();
                            $entityManager->persist($emprunte);
                            $entityManager->flush();


                        }
                    }

                }
            }

            return $this->redirectToRoute('emprunte_index');
        }

        return $this->render('emprunte/new.html.twig', [
            'titre' => 'Emprunte', 'soustitre' => 'Nouveau',
            'emprunte' => $emprunte,
            'lien' => $this->generateUrl('emprunte_index'),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprunte_show", methods={"GET"})
     */
    public function show(Emprunte $emprunte): Response
    {

        return $this->render('emprunte/show.html.twig', [
            'titre' => 'Emprunte', 'soustitre' => '', 'lien' => $this->generateUrl('emprunte_index'),
            'emprunte' => $emprunte,
        ]);

    }

    /**
     * @Route("/{id}/edit", name="emprunte_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Emprunte $emprunte, EmprunteRepository $emprunteRepository): Response
    {
        // $form = $this->createForm(EmprunteType::class, $emprunte);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
        $empruntes = $emprunteRepository->findAll();

        $repLivre = $this->getDoctrine()->getRepository(Livre::class);
        $livres = $repLivre->findAll();
        $livreE = $emprunte->getLivres();
        if ($emprunte->getEtat() == "Non Retourné") {
            foreach ($livres as $livre) {
                foreach ($livreE as $le) {
                    if ($livre == $le) {
                        $livre->setNbrexemplaires($livre->getNbrexemplaires() + 1);
                        $emprunte->setEtat("Retourné");
                        $this->getDoctrine()->getManager()->flush();
                    }
                }
            }
        }

        return $this->redirectToRoute('emprunte_index');
        // }

        return $this->render('emprunte/edit.html.twig', [
            'titre' => 'Emprunte', 'soustitre' => 'Editer', 'lien' => $this->generateUrl('emprunte_index'),
            'emprunte' => $emprunte,
            //'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="emprunte_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Emprunte $emprunte): Response
    {
        if (($this->isCsrfTokenValid('delete' . $emprunte->getId(), $request->request->get('_token')))) {
            if (($emprunte->getEtat() == "Retourné")) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($emprunte);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('emprunte_index');
    }

    /**
     * @Route("/suuprimer/{id}", name="emprunte_delete_2")
     */
    public function supprimer(Request $request, int $id): Response
    {
        {
            if ($id > 0) {

                $emprunte = $this->getDoctrine()->getRepository(Emprunte::class)->findOneBy(['id' => $id]);
                $em = $this->getDoctrine()->getManager();
                $em->remove($emprunte);
                $em->flush();
            }
            return $this->redirectToRoute('emprunte_index');
        }

    }
}
