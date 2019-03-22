<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class  AdminPropertyController extends  AbstractController{

    /**
     * @var PropertyRepository
    */
    public function __construct(PropertyRepository $repository)
    {
         $this->repository = $repository;
    }

    /**
     * @Route("/admin", name="admin.property.index")
     * @return Response
     */
    public function  index()
    {
       $properties= $this->repository->findAll();
       return $this->render('admin/property/index.html.twig', compact('properties')); #compact permet de retourner le rt dans un tableau
    }

    /**
     * @Route("/admin/{id}", name="admin.property.edit")
     */
    public function edit(Property $property)
    {
        return $this->render('admin/property/edit.html.twig', compact('property'));
    }
}