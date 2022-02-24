<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CatNSRepository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo; // gedmo annotations
use Gedmo\Timestampable;

/**
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="categories")
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'categories')]
#[ORM\Entity(repositoryClass: NestedTreeRepository::class)]

class CatNS
{
    /**
     * @var int|null
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=64)
     */
    #[ORM\Column(name: 'title', type: Types::STRING, length: 64)]
    private $title;

    /**
     * @var int|null
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(name="lft", type="integer")
     */
    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: Types::INTEGER)]
    private $lft;

    /**
     * @var int|null
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl", type="integer")
     */
    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: Types::INTEGER)]
    private $lvl;

    /**
     * @var int|null
     *
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt", type="integer")
     */
    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: Types::INTEGER)]
    private $rgt;

    /**
     * @var self|null
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="tree_root", referencedColumnName="id", onDelete="CASCADE")
     */
    #[Gedmo\TreeRoot]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $root;

    /**
     * @var self|null
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private $parent;

    /**
     * @var Collection<int, Category>
     *
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private $children;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setParent(self $parent = null): void
    {
        $this->parent = $parent;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }
}