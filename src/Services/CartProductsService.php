<?php

namespace App\Services;

use App\Entity\CartProduct;
use App\Entity\Carts\Cart;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Example;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;

class CartProductsService extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;


    }

    public function add_product_to_cart($cart, $product)
    {
        $cart_product = $this->get_cart_product($cart,$product);
        if ($product->getAmount() > 0) {
            if ($cart_product) {
                $cart_product->setAmount($cart_product->getAmount() + 1);

            } else{
                $cart_product = $this->crate_cart_product($cart, $product);
                $cart->setTotalAmount($cart->getTotalAmount()+1);
            }

            $product->setAmount($product->getAmount() - 1);

            $cart->setTotalPrice($cart->getTotalPrice()+$product->getPrice());

        }
        else
            throw new Exception('amount equal zero ');

        $this->entityManager->persist($cart_product);
        $this->entityManager->persist($product);
        $this->entityManager->persist($cart);

        $this->entityManager->flush();
    }

    public function crate_cart_product($cart, $product)
    {
        $cart_product = new CartProduct();
        $cart_product->setProduct($product);
        $cart_product->setCart($cart);
        $cart_product->setAmount(1);
        return $cart_product;
    }

    public function delete_product_from_cart($cart,$product)
    {
        $cart_product = $this->get_cart_product($cart,$product);
        $cart_product->setAmount($cart_product->getAmount() - 1);
        if ($cart_product->getAmount() <=0){
            $this->entityManager->remove($cart_product);
            $cart->setTotalAmount($cart->getTotalAmount() - 1);
        }


        $product->setAmount($product->getAmount()+ 1);

        $cart->setTotalPrice($cart->getTotalPrice() - $product->getPrice());

        $this->entityManager->persist($product);
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

    }

    public function get_cart_product($cart,$product)
    {
      return   $this->entityManager
            ->getRepository(CartProduct::class)
            ->findOneBy(['product' => $product, 'cart' => $cart]);
    }
    public function empty_cart( $cart)
    {
        $cart_products =   $this->entityManager
            ->getRepository(CartProduct::class)
            ->findALl();

        $cart->setTotalAmount(0);

        foreach ($cart_products as $cart_product){
            $product = $cart_product->getProduct();
            $product->setAmount($product->getAmount() + $cart_product->getAmount() );
            $this->entityManager->remove($cart_product);
        }

        $this->entityManager->flush();
    }

}