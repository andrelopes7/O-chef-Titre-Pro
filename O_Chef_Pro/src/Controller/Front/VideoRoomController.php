<?php

namespace App\Controller\Front;

use App\Entity\VideoRoom;
use App\Form\VideoRoomType;
use App\Repository\VideoRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/video/room")
 */
class VideoRoomController extends AbstractController
{
    /**
     * @Route("/", name="video_room_index", methods={"GET"})
     */
    public function index(VideoRoomRepository $videoRoomRepository): Response
    {
        return $this->render('front/video_room/index.html.twig', [
            'video_rooms' => $videoRoomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="video_room_show", methods={"GET"})
     */
    public function show(VideoRoom $videoRoom): Response
    {
        return $this->render('front/video_room/show.html.twig', [
            'video_room' => $videoRoom,
        ]);
    }

}
