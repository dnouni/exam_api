<?php

namespace App\Entity;


use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransactionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ApiResource(
    collectionOperations:[
        'get',
        'post'=> [
            'denormalization_contexte' => [
                'groups' => ['Transaction:post']
            ]
        ]
    ],
    itemOperations:[
        'get',
        'put',
        'delete',
    ],
)]class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateTransaction = null;

    #[ORM\Column]
    private ?float $montantEth = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?nft $nft = null;

    #[ORM\ManyToOne(inversedBy: 'transactions')]
    private ?Utilisateur $utilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->dateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $dateTransaction): static
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    public function getMontantEth(): ?float
    {
        return $this->montantEth;
    }

    public function setMontantEth(float $montantEth): static
    {
        $this->montantEth = $montantEth;

        return $this;
    }

    public function getNft(): ?nft
    {
        return $this->nft;
    }

    public function setNft(?nft $nft): static
    {
        $this->nft = $nft;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
