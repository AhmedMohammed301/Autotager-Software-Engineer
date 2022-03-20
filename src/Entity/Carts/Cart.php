<?php

namespace App\Entity\Carts;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\User;
use App\Repository\CartRepository;
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

    #[ORM\Column(type: 'integer')]
    private $product_count;

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

    public function getProductCount(): ?int
    {
        return $this->product_count;
    }

    public function setProductCount(int $product_count): self
    {
        $this->product_count = $product_count;

        return $this;
    }
}
