<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @Route("/admin/category")
 * @Vich\Uploadable
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="admin_category_index", methods={"GET"})
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('back/category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_category_new", methods={"GET","POST"})
     */
    public function new(Request $request/* , FileUploader $fileUploader */): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $category->setCreatedAt(new \datetime());
            $category->setUpdatedAt(new \datetime());

            $entityManager->persist($category);
            $entityManager->flush();

           /*  // on gère l'image après un 1er flush car on a besoin de l'id pour générer le nom
            $image = $form->get('picture')->getData();
            $fileUploader->moveCategoryPicture($image, $category);
 */
            // il faut penser à flush à nouveau pour prendre en compte le nom de l'image
            $entityManager->flush();

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('back/category/new.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_category_show", methods={"GET"})
     */
    public function show(Category $category): Response
    {
        return $this->render('back/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Category $category/* , FileUploader $fileUploader */): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // puisque l'image n'est pas mappé, il faut la traiter manuellement

           /*  $image = $form->get('picture')->getData();
            $fileUploader->moveCategoryPicture($image, $category); */

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Category modifiée');

            return $this->redirectToRoute('admin_category_index');
        }

        return $this->render('back/category/edit.html.twig', [
            'category' => $category,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Category $category): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_category_index');
    }
}
