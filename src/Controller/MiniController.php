<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EmployeRepository;
use App\Entity\Employe;
use App\Entity\Service;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\EmployerType;
use Symfony\Component\HttpFoundation\Request;


class MiniController extends AbstractController
{
    /**
     * @Route("/mini", name="mini")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $employe = new Employe();
       
        $form = $this->createForm(EmployerType::class, $employe);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($employe);
            $manager->flush();

            return $this->redirectToRoute("home");
        }
        return $this->render('mini/index.html.twig',[
            'formEmploye' => $form->createView()
            ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(EmployeRepository $repo){
        $employes=$repo->findAll();
        return $this->render('mini/home.html.twig',['employes'=>$employes]);
    }
    
}
