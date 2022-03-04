<?php
declare(strict_types = 1); 
namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateUserController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Create new user 
     * 
     * @Route("/api/client/{id}/user", name="app_create_user", methods={"POST"})
     *
     * @param Client $data
     * @param Request $request
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */ 
    public function __invoke(Client $data, Request $request, SerializerInterface $serializer, ValidatorInterface $validator, NormalizerInterface $normalizer): JsonResponse
    {
        $userLogged = ($this->getUser())
        ->getUserIdentifier();
        
        //Verif proprietaire
        if ($userLogged === $data->getUserIdentifier()) {
            //contrainte unique prenom et nom
            //1 - Json > Obj User
            $user = $serializer->deserialize($request->getContent(), User::class, 'json'); //ok
            //3 - Verifie la validité de l’entite avant de persister.
            $errors = $validator->validate($user);

            if (count($errors) > 0) { //Error Processing Request
                // recuperer le message d'erreur 
                //$message = $errors->ge
                throw new \Exception("une erreur dans le Json envoye - Error Processing Request", 404); //[a corriger] ICI PROBLEM MAL CODE
            }

            //2 - Client::addUser
            $data->addUser($user);

            $this->em->persist($user);
            $this->em->flush(); //ok enregistre

            //Obj > Array   The HTTP status code "0" is not valid.
            $response =  $normalizer->normalize($user); // Le normalizer ne fonctionne pas.
        
            return new JsonResponse($response);  // need array  

        }else{
            throw new \Exception('Vous n\'etes pas authorise à modidier ce client', ); // corriger ce throw
        }
    }
}

