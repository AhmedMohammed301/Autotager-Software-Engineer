<?php

namespace App\Controller;

use App\Factory\ProductFactory;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Entity\Product;
use App\Entity\SaleProduct;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private $entityManager;
    protected $productFatory;

    public function __construct(ProductFactory $productFatory, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->productFatory = $productFatory;

    }


    #[Route('/product/{type}', name: 'product_type')]
    public function index($type): Response
    {
        $class = $this->productFatory->getProductType($type);
        $products = $this->entityManager->getRepository($class)->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'type' =>ucfirst($type)
        ]);
    }
}
