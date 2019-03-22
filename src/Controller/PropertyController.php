<?php

#toujours commencer par mentionner le namespace
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController {


#<!--
#le bloc qui suit doit se placer dans la fonction index
    #ppremier methode d'insertion dans le code en dur hahahah

    #après avoir généré les entités on doit faire toujours cette action
    # $property = new Property();
    #$property->setTitle('Mon premier bien')
    #        ->setPrice(200000)
    #       ->setRooms(4)
    #      ->setBedrooms(3)
    #     ->setDescription('une petite description')
    #   ->setSurface(60)
    #  ->setFloor(4)
    # ->setHeat(1)
    #->setCity('Montpellier')
    #->setAddress('15 rue Boulevard du 20 mai')
    #->setPostalCode('34000');
    #une fois les données envoyées on fais la persistance et envoi a la bd
    #$em = $this->getDoctrine()->getManager();
    #$em->persist($property); #persistance de l'entité
    #$em->flush(); #permet de porter les données dans em vers la bd

    #recupere la données enrégistrée 1ere methode
    # $repository = $this->getDoctrine()->getRepository(Property::class); #instanciation du repository
    #dump($repository); #voir ce que ça retourne
    #$property = $this->repository->findAllVisible();
    #dump($property); affiche sous le terminal la variable
    # $property[0]->setSold(false); modifie la valeur du solde avant ajout
    #$this->em->flush();#permet de faire la mise à jour
#-->

    #recupere la données enrégistrée 2eme methode
    #ajout du 2em paramètre pour les mises à jours
    /**
     * @var PropertyRepository
     */
    private $repository;
    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/biens", name="property.index",)
    * @return Response
     */
    public function index(): Response
    {
        return $this->render('property/index.html.twig',[
            'current_menu' => 'properties'
        ]);
    }
    # 'property' => $property, envoie du proprité à la vue
    # statut 301 redirection instantanée
    #$slug, $id utiliser premierement en paramètre pour retourner une page
    #$property = $this->repository->find($id); dans la même idée ajouter cette ligne
    #requirements indique à quoi doivent ressembler les differentes paramètres
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
    {
        #verifie si le slug fonctionne
        if ($property->getSlug() !== $slug){
            #si ce n'est pas egale redirection vers une route
            #cet bloc de code est très important pour le référencement des url
           return  $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ],301);
        }
        return $this->render('property/show.html.twig',[
            'property' => $property,
            'current_menu'  => 'properties'
        ]);
    }
}