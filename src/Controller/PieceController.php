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
    #[Route(path: 'api/piece/{id}', name: 'piece_by_id', methods: ['GET'])]
    public function getPieceById(int $id, PieceRepository $pieceRepository, SerializerInterface $serializer): JsonResponse
    {
        $piece = $pieceRepository->find($id);
        if (!$piece) {
            return new JsonResponse(['message' => 'piece not found'], Response::HTTP_NOT_FOUND);
        }
        $jsonPiece = $serializer->serialize($piece, 'json');
        return new JsonResponse($jsonPiece, Response::HTTP_OK, [], true);
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

    #[Route('/api/piece/{id}', name: 'delete_piece', methods: ['DELETE'])]
    public function deletePiece(int $id, PieceRepository $pieceRepository, EntityManagerInterface $em): JsonResponse
    {
        $piece = $pieceRepository->find($id);
        if (!$piece) {

            return new JsonResponse(['error' => 'Piece not found'], Response::HTTP_NOT_FOUND);
        }

        $em->remove($piece);
        $em->flush();
        return new JsonResponse(['message' => 'Piece deleted successfully'], Response::HTTP_OK);
    }
    #[Route(path: '/api/piece/{id}', name: 'update_piece', methods: ['PATCH'])]
    public function updatePiece(int $id, PieceRepository $pieceRepository, EntityManagerInterface $em, Request $request): JsonResponse
    {
        $piece = $pieceRepository->find($id);

        if (!$piece) {
            return new JsonResponse(['error' => 'Piece not found'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        // Mise à jour des propriétés si elles sont fournies
        if (isset($data['name'])) {
            $piece->setName($data['name']);
        }
        if (isset($data['description'])) {
            $piece->setDescription($data['description']);
        }
        if (isset($data['brand'])) {
            $piece->setBrand($data['brand']);
        }
        if (isset($data['buyingPrice'])) {
            $piece->setBuyingPrice($data['buyingPrice']);
        }
        if (isset($data['quantity'])) {
            $piece->setQuantity($data['quantity']);
        }
        if (isset($data['category'])) {
            $piece->setCategory($data['category']);
        }

        // Persiste les modifications dans la base de données
        $em->flush();

        return new JsonResponse(['message' => 'Piece updated successfully'], Response::HTTP_OK);
    }

}