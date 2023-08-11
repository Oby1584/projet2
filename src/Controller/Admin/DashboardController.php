<?php

namespace App\Controller\Admin;

use App\Entity\Vehicule;
use App\Repository\VehiculeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin')]
class DashboardController extends AbstractController
{
    #[Route('/', name: 'admin_accueil')]
    public function index(VehiculeRepository $repo): Response
    { 
        $fichier = $repo->findAll();
        return $this->render('admin/index.html.twig', [
            'fichier' =>  $fichier,
        ]);
    }

    
}


