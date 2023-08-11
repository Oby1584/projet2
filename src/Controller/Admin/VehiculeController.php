<?php

namespace App\Controller\Admin;

use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin')]
class VehiculeController extends AbstractController
{
    
    #[Route('/vehicule', name: 'app_vehicule')]
    public function index(): Response
    {
        return $this->render('admin/vehicule/index.html.twig', [
            'controller_name' => 'VehiculeController',
        ]);
    }
    #[Route('/vehicule/modifier/{id}', name:"app_modifier")]

    #[Route('/vehicule/ajout', name:"blog_ajout")]
    public function form(Request $globals, EntityManagerInterface $manager, Vehicule $vehicule = null):response
    {
        
        // $vehicule = new vehicule;
        
        if($vehicule == null)
        {
            $vehicule = new vehicule;  
        }
        
        $form = $this->createForm(VehiculeFormType::class, $vehicule);


        $form->handleRequest($globals);
        // : handleRequest() permet de récupérer toutes les données de mes inputs

        if($form->isSubmitted() && $form->isValid())
        {
        
            $vehicule->setDateEnregistrement(new \DateTime());
            $manager->persist($vehicule);

            $manager->flush();

            
            return $this->redirectToRoute('fichier');
        }

        return $this->render('admin/vehicule/form.html.twig', [
            'form' => $form,

           
        ]);
    }

   
   
   
   
   
   
   
   
    #[Route('/vehicule/fichier', name: 'fichier')]
    public function fichier(VehiculeRepository $repo)
    {
        $fichier = $repo->findAll();

        return $this->render('app/fichier.html.twig', [
            'fichier'=> $fichier
        ]);
    }


    #[Route('/app/voir/{id}', name:"app_voir")]
    public function voir($id, VehiculeRepository $repo)
    {
        $vehicule = $repo->find($id);
        return $this->render('app/voir.html.twig', [
            'voir' => $vehicule,
        ]);
    }











    #[Route('/vehicule/supprimer/{id}', name: 'app_supprimer')]
     public function supprimer(Vehicule $vehicule, EntityManagerInterface $manager)
     {
        $manager->remove($vehicule);
        $manager->flush();
        return $this->redirectToRoute('fichier');


     }

   
}
