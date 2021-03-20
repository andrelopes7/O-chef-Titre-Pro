<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Vich\Uploadable
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="integer")
     */
    private $time;

    /**
     * @ORM\Column(type="integer")
     */
    private $portions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $danger_level;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $difficult;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recipes")
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $countries;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="recipe")
     */
    private $posts;

    /**
     * @ORM\ManyToMany(targetEntity=Blog::class, inversedBy="recipes")
     */
    private $blog;


    /**
     * @ORM\ManyToMany(targetEntity=Learn::class, inversedBy="recipes")
     */
    private $learn;

    /**
     * @ORM\OneToOne(targetEntity=VideoRoom::class, inversedBy="recipe", cascade={"persist", "remove"})
     */
    private $video_room;

    /**
     * @ORM\ManyToMany(targetEntity=Diet::class, mappedBy="recipe")
     */
    private $diets;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="recipes")
     */
    private $utilisateur;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->blog = new ArrayCollection();
        $this->learn = new ArrayCollection();
        $this->diets = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPortions(): ?int
    {
        return $this->portions;
    }

    public function setPortions(int $portions): self
    {
        $this->portions = $portions;

        return $this;
    }

    public function getDangerLevel(): ?string
    {
        return $this->danger_level;
    }

    public function setDangerLevel(string $danger_level): self
    {
        $this->danger_level = $danger_level;

        return $this;
    }

    public function getDifficult(): ?string
    {
        return $this->difficult;
    }

    public function setDifficult(string $difficult): self
    {
        $this->difficult = $difficult;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    public function getCountries(): ?Country
    {
        return $this->countries;
    }

    public function setCountries(?Country $countries): self
    {
        $this->countries = $countries;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setRecipe($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getRecipe() === $this) {
                $post->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Blog[]
     */
    public function getBlog(): Collection
    {
        return $this->blog;
    }

    public function addBlog(Blog $blog): self
    {
        if (!$this->blog->contains($blog)) {
            $this->blog[] = $blog;
        }

        return $this;
    }

    public function removeBlog(Blog $blog): self
    {
        $this->blog->removeElement($blog);

        return $this;
    }


    /**
     * @return Collection|Learn[]
     */
    public function getLearn(): Collection
    {
        return $this->learn;
    }

    public function addLearn(Learn $learn): self
    {
        if (!$this->learn->contains($learn)) {
            $this->learn[] = $learn;
        }

        return $this;
    }

    public function removeLearn(Learn $learn): self
    {
        $this->learn->removeElement($learn);

        return $this;
    }

    public function getVideoRoom(): ?VideoRoom
    {
        return $this->video_room;
    }

    public function setVideoRoom(?VideoRoom $video_room): self
    {
        $this->video_room = $video_room;

        return $this;
    }

    /**
     * @return Collection|Diet[]
     */
    public function getDiets(): Collection
    {
        return $this->diets;
    }

    public function addDiet(Diet $diet): self
    {
        if (!$this->diets->contains($diet)) {
            $this->diets[] = $diet;
            $diet->addRecipe($this);
        }

        return $this;
    }

    public function removeDiet(Diet $diet): self
    {
        if ($this->diets->removeElement($diet)) {
            $diet->removeRecipe($this);
        }

        return $this;
    }

    /* public function setPictureFile(?File $pictureFile = null): void
    {
        $this->pictureFile = $pictureFile;

        if (null !== $pictureFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    } */

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

   
}
