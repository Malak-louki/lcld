<?php

namespace App\Controller;

use App\Entity\GraphicsCard;
use App\Entity\Keyboard;
use App\Entity\Monitor;
use App\Entity\Motherboard;
use App\Entity\MousePad;
use App\Entity\Piece;
use App\Entity\PowerSupply;
use App\Entity\Processor;
use App\Entity\RAM;
use App\Entity\Storage;
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
use Doctrine\Common\Collections\ArrayCollection;

class PieceController extends AbstractController
{

    #[Route('/api/piece/list', name: 'pieces_list', methods: ['GET'])]
    public function getAllPieces(PieceRepository $pieceRepository, SerializerInterface $serializer): Response
    {
        $piecesList = $pieceRepository->findAll();
        $jsonPieceList = $serializer->serialize($piecesList, 'json');
        return new JsonResponse($jsonPieceList, Response::HTTP_OK, [], true);
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

    #[Route('/api/piece/add', name: 'add_piece', methods: ['POST'])]
    public function addPiece(
        PieceRepository $pieceRepository,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        UrlGeneratorInterface $urlGenerator,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        // Déterminer le type de la pièce
        $type = $data['type'] ?? null;
        if ($type === null) {
            return new JsonResponse(['error' => 'Piece Type is required'], Response::HTTP_BAD_REQUEST);
        }

        // Instancier la bonne classe en fonction du type
        switch (strtolower($type)) {
            case 'motherboard':
                $pieceClass = Motherboard::class;
                break;
            case 'processor':
                $pieceClass = Processor::class;
                break;
            case 'graphicscard':
                $pieceClass = GraphicsCard::class;
                break;
            case 'ram':
                $pieceClass = RAM::class;
                break;
            case 'keyboard':
                $pieceClass = Keyboard::class;
                break;
            case 'mousepad':
                $pieceClass = MousePad::class;
                break;
            case 'monitor':
                $pieceClass = Monitor::class;
                break;
            case 'powersupply':
                $pieceClass = PowerSupply::class;
                break;
            case 'storage':
                $pieceClass = Storage::class;
                break;
            default:
                return new JsonResponse(['error' => 'Invalid type'], Response::HTTP_BAD_REQUEST);
        }

        // Désérialiser les données dans la bonne classe
        $piece = $serializer->deserialize($request->getContent(), $pieceClass, 'json');

        // Valider l'entité
        $errors = $validator->validate($piece);
        if (count($errors) > 0) {
            return new JsonResponse((string) $errors, Response::HTTP_BAD_REQUEST);
        }

        // Enregistrer dans la base de données
        $em->persist($piece);
        $em->flush();

        // Retourner une réponse JSON avec les données de la pièce ajoutée
        $jsonPiece = $serializer->serialize($piece, 'json');
        return new JsonResponse($jsonPiece, Response::HTTP_CREATED, [], true);
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

        $em->flush();

        return new JsonResponse(['message' => 'Piece updated successfully'], Response::HTTP_OK);
    }

}