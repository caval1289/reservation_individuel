<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artist;
use App\Repository\ArtistRepository;

#[Route('/artist')]
class ArtistController extends AbstractController
{
    #[Route('/', name:'artist_index', methods: ['GET'])]
    public function index(ArtistRepository $repository): Response
    {
        $artists = $repository->findAll();

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
            'resource' => 'artistes',
        ]);
    }
    #[Route('/{id}', name:'artist_show', methods: ['GET'])]
    public function show(int $id, ArtistRepository $repository): Response
    {
        $artist = $repository->find($id);

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }
 
}



