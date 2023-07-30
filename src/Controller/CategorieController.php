<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\AddCategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{

    public function __construct(
    private EntityManagerInterface $entityManager,

)
{
}


    #[Route('/categories', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findAll();
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'categories' => $categorie
        ]);
    }



    #[Route('/categories/add_categories', name: 'app_categories_add')]
    public function CategoriesAdd(Request $request): Response
    {
        $categories = new Categorie();
        $form = $this->createForm(AddCategorieType::class, $categories);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($categories);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_categorie');
        }

        return $this->render('categorie/formAdd.html.twig', [
            'controller_name' => 'CategorieController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/categories/update_categories/{id}', name: 'app_categories_update')]
    public function CategoriesUpdate(Request $request, $id, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->find($id);
        $form = $this->createForm(AddCategorieType::class, $categories);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($categories);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_categorie');
        }

        return $this->render('categorie/formAdd.html.twig', [
            'controller_name' => 'CategorieController',
            'form' => $form->createView()
        ]);
    }


    #[Route('/categories/remove_categories/{id}', name: 'app_categories_remove')]
    public function CategoriesRemove(Request $request, $id, CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->find($id);


        $this->entityManager->remove($categories);

        $this->entityManager->flush();


        return $this->redirectToRoute('app_categorie');
    }
}
