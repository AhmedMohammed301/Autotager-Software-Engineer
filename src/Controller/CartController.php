<?php

namespace App\Controller;

use App\Entity\Carts\Cart;
use App\Entity\Products\Product;
use App\Factories\CartFactory;
use App\Services\CartProductsService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager;
    protected $cartFactory;
    private $cartProductServe;
    public function __construct(CartFactory $cartFactory, EntityManagerInterface $entityManager,CartProductsService $cartProductServe)
    {
        $this->entityManager = $entityManager;
        $this->cartFactory = $cartFactory;
        $this->cartProductServe=$cartProductServe;
    }
    #[Route('/cart/{name}', name: 'app_cart')]

    public function index(Cart $cart): Response
    {
        $products = $cart->getCartProducts();
        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'products' => $products,
        ]);
    }
    #[Route('/cart/{cart}/product/{product}/add', name: 'add_product_to_cart')]
    #[ParamConverter('cart', options: ['mapping' => ['cart' => 'id']])]
    #[ParamConverter('product', options: ['mapping' => ['product' => 'id']])]
    public function addProductToCart(Cart $cart, Product $product)
    {

         $this->cartProductServe->add_product_to_cart($cart,$product);
        return new RedirectResponse($this->generateUrl('product_type',['type'=>'sale']));
    }

    #[Route('/cart/{cart}/product/{product}/delete', name: 'delete_product_to_cart')]
    #[ParamConverter('cart', options: ['mapping' => ['cart' => 'id']])]
    #[ParamConverter('product', options: ['mapping' => ['product' => 'id']])]
    public function deleteProductFromCart(Cart $cart, Product $product)
    {

        $this->cartProductServe->delete_product_from_cart($cart,$product);
        return new RedirectResponse($this->generateUrl('app_cart',['name'=>$cart->getName()]));
    }
    #[Route('/cart/{id}/delete', name: 'empty_cart')]
    public function emptyCart(Cart $cart)
    {

        $this->cartProductServe->empty_cart($cart);

        return new RedirectResponse($this->generateUrl('app_cart',['name'=>$cart->getName()]));

    }



}
