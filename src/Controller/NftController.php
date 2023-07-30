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

class NftController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,

    )
    {
    }


    #[Route('/nft', name: 'app_nft')]
    public function index(): Response
    {


        return $this->render('nft/index.html.twig', [
            'controller_name' => 'NftController',
        ]);
    }

    #[Route('/addCategorie', name: 'app_categorie_add')]
    public function AlbumAdd(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(AddCategorieType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($categorie);
            $this->entityManager->flush();
        }

        return $this->render('nft/formAdd.html.twig', [
            'controller_name' => 'GenreController',
            'form' => $form->createView()
        ]);
    }
}
