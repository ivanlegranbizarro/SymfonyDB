<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
  public function __construct(private EntityManagerInterface $em)
  {
  }
  #[Route('/', name: 'app_home')]
  public function home(Product $product): Response
  {
    $products = $this->em->getRepository(Product::class)->findALlProductsWithCommentsAndTags();
    return $this->render('page/home.html.twig', ['products' => $products]);
  }

  #[Route('/product/{id}', name: 'app_product')]
  public function product(Product $product): Response
  {
    return $this->render('page/product.html.twig', ['product' => $product]);
  }

  #[Route('/tag/{id}', name: 'app_tag')]
  public function tag(Tag $tag): Response
  {
    return $this->render('page/tag.html.twig', ['tag' => $tag]);
  }
}
