<?php

namespace App\Controller;

use App\Entity\Piece;
use App\Repository\PieceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PieceController extends AbstractController
{
    #[Route('/api/piece/list', name: 'liste des pieces', methods: ['GET'])]
    public function getAllPieces(PieceRepository $pieceRepository): Response
    {
        return $this->render('piece/index.html.twig', [
            'pieces' => $pieceRepository->findAll(),
        ]);
    }
    #[Route('/api/piece/add', name: 'ajout_des_pieces', methods: ['POST'])]
    public function addPiece(
        PieceRepository $pieceRepository,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = $request->getContent();
        $piece = $serializer->deserialize($data, Piece::class, 'json');

        $errors = $validator->validate($piece);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            return new JsonResponse($errorsString, Response::HTTP_BAD_REQUEST);
        }
        $em->persist($piece);
        $em->flush();

        $jsonPiece = $serializer->serialize($piece, 'json');
        return new JsonResponse($jsonPiece, Response::HTTP_CREATED, [], true);
    }
    public function index(): Response
    {
        return $this->render('piece/index.html.twig', [
            'PieceController' => 'PieceController',
        ]);
    }
}



