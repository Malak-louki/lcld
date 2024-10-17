<?php

namespace App\Controller;

use App\Entity\Model;
use App\Repository\ModelRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ModelController extends AbstractController
{
    #[Route('/api/model/add', name: 'add_model', methods: ['POST'])]
    public function addModel(
        ModelRepository $modelRepository,
        Request $request,
        EntityManagerInterface $em,
        SerializerInterface $serializer,
        ValidatorInterface $validator
    ): JsonResponse
    {
        $data= $request->getContent();
        $model =$serializer->deserialize($data, Model::class, 'json');
        $errors = $validator->validate($model);
        if(count($errors)>0){
            $errorsString = (string) $errors;
            return new JsonResponse($errorsString, Response::HTTP_BAD_REQUEST);
        }
        $em->persist($model);
        $em->flush();
        $jsonModel = $serializer->serialize($model, 'json');
        return new JsonResponse($jsonModel, Response::HTTP_CREATED, [], true);
    }
}
