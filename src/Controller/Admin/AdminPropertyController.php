<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class  AdminPropertyController extends  AbstractController{

    #ObjectManager $em on ajout ceci au contruecteur lorsqu'on veut communiquer avec la bd
    /**
     * @var PropertyRepository
    */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
         $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function  index()
    {
       $properties= $this->repository->findAll();
       return $this->render('admin/property/index.html.twig', compact('properties')); #compact permet de retourner le rt dans un tableau
    }

    #create
    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        #demende au controlleur de gérer la réquête ce quant l'on veut editer le formulaire
        $form->handleRequest($request);
        #test si le form est envoyé
        if ($form->isSubmitted() && $form->isValid()){
            #persistance des données
            $this->em->persist($property);
            $this->em->flush();
            #permet de confirmer la mise à jour
            $this->addFlash('success','Bien créé avec success');
            #retour sur la vue
            return $this->redirectToRoute('admin.property.index');
        }
        #si tout se passe bien on retourne vers la vue
        return $this->render('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
   #update
    #Request $request ajouter pour gérer toute les requêtes
    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function edit(Property $property, Request $request)
    {
        ##ajout des options afin de sauvegarder les option dans la bd et en respectant la relation
           # $option = new Option();
            #$property->addOption($option);
        ##fin ajout des fonctions

        #ajouter la ligne suivante lorqu'on travail avec le formulaire comme vue
        #on n'envoi pas le form ($form) mais plutot la methode create view de $form
        $form = $this->createForm(PropertyType::class, $property);
        #demende au controlleur de gérer la réquête ce quant l'on veut editer le formulaire
        $form->handleRequest($request);
        #test si le form est envoyé
        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            #permet de confirmer la mise à jour
            $this->addFlash('success','Bien modifié avec success');
            #retour sur la vue
            return $this->redirectToRoute('admin.property.index');
        }
        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
    #delete
    #verification du token avec la syntaxe et l'id en paramètre

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\RedirectResponse;
     */
    public function delete(Property $property, Request $request){
      // if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))){
        //  $submittedToken = $request->request->get('token');
        //if ($this->isCsrfTokenValid('delete-item', $submittedToken)) {
           $this->em->remove($property);
           $this->em->flush();
        #permet de confirmer la mise à jour
        $this->addFlash('success','Bien supprimé avec success');
       //}
       return $this->redirectToRoute('admin.property.index');
    }
}