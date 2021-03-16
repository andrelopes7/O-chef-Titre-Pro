<?php

namespace App\Controller\Admin;

use App\Entity\VideoRoom;
use App\Form\VideoRoomType;
use App\Repository\VideoRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/video-room")
 */
class VideoRoomController extends AbstractController
{
    /**
     * @Route("/", name="admin_video_room_index", methods={"GET"})
     */
    public function index(VideoRoomRepository $videoRoomRepository): Response
    {
        return $this->render('back/video_room/index.html.twig', [
            'video_rooms' => $videoRoomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_video_room_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $videoRoom = new VideoRoom();
        $form = $this->createForm(VideoRoomType::class, $videoRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $videoRoom->setCreatedAt(new \datetime());
            $videoRoom->setUpdatedAt(new \datetime());

            $entityManager->persist($videoRoom);
            $entityManager->flush();

            return $this->redirectToRoute('admin_video_room_index');
        }

        return $this->render('back/video_room/new.html.twig', [
            'video_room' => $videoRoom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_video_room_show", methods={"GET"})
     */
    public function show(VideoRoom $videoRoom): Response
    {
        return $this->render('back/video_room/show.html.twig', [
            'video_room' => $videoRoom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_video_room_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, VideoRoom $videoRoom): Response
    {
        $form = $this->createForm(VideoRoomType::class, $videoRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_video_room_index');
        }

        return $this->render('back/video_room/edit.html.twig', [
            'video_room' => $videoRoom,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_video_room_delete", methods={"DELETE"})
     */
    public function delete(Request $request, VideoRoom $videoRoom): Response
    {
        if ($this->isCsrfTokenValid('delete'.$videoRoom->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($videoRoom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_video_room_index');
    }
}
