<?php

namespace App\Controller;

use App\Factory\CartFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager;
    protected $cartFactory;

    public function __construct(CartFactory $cartFactory, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->cartFactory = $cartFactory;

    }
    #[Route('/cart/{type}', name: 'app_cart')]

    public function index($type): Response
    {

        $class = $this->cartFactory->getCartType($type);
        $cart = $this->entityManager->getRepository($class)->findBy(['user'=>$this->getUser()]);

        //$products = $cart->getProducts();
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
        ]);
    }

}
