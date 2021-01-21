<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Cursus;
use App\Entity\Profil;
use DateTimeImmutable;
use App\Entity\ConnectedAt;
use App\Entity\CursusFollowed;
use App\Security\EmailVerifier;
use App\Form\RegistrationFormType;
use App\Security\UserAuthenticator;
use Symfony\Component\Mime\Address;
use App\Repository\CursusRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;


class AuthController extends AbstractController
{

    /**
     * register a new User
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        //$username = $request->request->get('username');

        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $roles = $request->request->get('roles');
        $machine = " dsdsq"; #$request->request->get('machine');
        if ($email === null) {
            $parameters = json_decode($request->getContent(), true);
            $email =  $parameters['email'];
            $machine =  "fdsfdsf"; #$parameters['machine'];
            $password =  $parameters['password'];
        }

        if (!$roles) {
            $roles = json_encode([]);
        }

        $user = new User($email);
        $user->setEmail($email);
        $user->setPassword($encoder->encodePassword($user, $password));
        //$user->setRoles(($roles));

        $profil = new Profil();
        $profil->setPseudo("");
        $user->setProfil($profil);

        $connectedAt = new ConnectedAt();
        $connectedAt->setProfil($profil);
        $connectedAt->setMachine($machine);
        $connectedAt->setLastUpdate(new DateTimeImmutable());

        $em->persist($user);
        $em->persist($profil);
        $em->persist($connectedAt);

        //Ex. $service = $repository->findBy(array('name' => 'Registration'),array('name' => 'ASC'),1 ,0)[0];      
        // $usersByRoleAndFirstname = $userRepo->findBy(["role" => "user", "firstname" => "First 2"]);
        /*
        $repository = $em->getRepository(Cursus::class);
        $newCursus = $repository->findOneBy(array('level' => -1));

        $newCursusFollowed = new CursusFollowed();
        $newCursusFollowed->setCursus($newCursus);
        $newCursusFollowed->setProfil($profil);
        $newCursusFollowed->setStartDate(new DateTimeImmutable());
        $em->persist($newCursusFollowed);
*/
        $em->flush();

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
