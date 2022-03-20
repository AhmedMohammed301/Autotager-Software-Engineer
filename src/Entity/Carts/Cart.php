<?php

namespace App\Entity\Carts;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\CartProduct;
use App\Entity\User;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorMap(["order" =>"OrderCart","wish-list" => "WishListCart"])]

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ApiResource]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'integer')]
    private $total_price;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: CartProduct::class)]
    private $cartProducts;

    #[ORM\Column(type: 'integer')]
    private $total_amount;


    public function __construct()
    {
        $this->cartProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    /**
     * @return Collection<int, CartProduct>
     */
    public function getCartProducts(): Collection
    {
        return $this->cartProducts;
    }

    public function addCartProduct(CartProduct $cartProduct): self
    {
        if (!$this->cartProducts->contains($cartProduct)) {
            $this->cartProducts[] = $cartProduct;
            $cartProduct->setCart($this);
        }

        return $this;
    }

    public function removeCartProduct(CartProduct $cartProduct): self
    {
        if ($this->cartProducts->removeElement($cartProduct)) {
            // set the owning side to null (unless already changed)
            if ($cartProduct->getCart() === $this) {
                $cartProduct->setCart(null);
            }
        }

        return $this;
    }
    public function getByType($type):bool
    {
        return $this->name===$type;
    }

    public function getTotalAmount(): ?int
    {
        return $this->total_amount;
    }

    public function setTotalAmount(int $total_amount): self
    {
        $this->total_amount = $total_amount;

        return $this;
    }
    public function isProductExist($product)
    {
        return $this->cartProducts->filter(function (CartProduct $cardProduct) use($product){
            return $cardProduct->getProduct==$product;
        })->first();
    }
}
