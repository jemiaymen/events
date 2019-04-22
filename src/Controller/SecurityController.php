<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Form\EditFormType;
use App\Form\ChangePasswordType;
use App\Form\RoleFormType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout()
    {
    }

    /**
     * @Route("/user/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('security/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/user/edit", name="app_edit_user")
     */
    public function edit(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();
        $userInfo = ['plainPassword' => null];

        $edit = $this->createForm(EditFormType::class, $user);
        $edit->handleRequest($request);

        $userInfo = ['plainPassword' => null];

        $changepw = $this->createForm(ChangePasswordType::class, $userInfo);
        $changepw->handleRequest($request);

        if ($edit->isSubmitted() && $edit->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_edit_user');
        }

        if ($changepw->isSubmitted() && $changepw->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $changepw->get('plainPassword')->getData()
                )
            );

            $entityManager->flush();

            return $this->redirectToRoute('app_edit_user');
        }

        return $this->render('security/edit.html.twig', [
            'EditForm' => $edit->createView(),
            'ChangePasswordForm' => $changepw->createView(),
            'news' => "[Info  - 9:43:57 PM] Connection to server got closed. Server will restart.
            Failed to load 8J, error: libunwind.so.8: cannot open shared object file: No such file or directory
            Failed to bind to CoreCLR at '/home/ajemi/.vscode/extensions/ms-vscode.csharp-1.18.0/.razor/libcoreclr.so'
            [Error - 9:43:57 PM] Connection to server got closed. Server will not be restarted.",
        ]);
    }


    /**
     * @Route("/user/role", name="app_user_role")
     */
    public function roles()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('security/role.list.html.twig',[
            'Users' => $users,
        ]);
    }



    /**
     * @Route("/user/role/{id}", name="app_edit_user_role")
     */
    public function editRole(Request $request,User $user) : Response
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $edit = $this->createForm(RoleFormType::class, $user);
        $edit->handleRequest($request);

        if ($edit->isSubmitted() && $edit->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $user->setRoles($edit->get('roles')->getData());
            $entityManager->flush();

            return $this->redirectToRoute('app_user_role');
        }

        return $this->render('security/role.html.twig',[
            'RoleForm' => $edit->createView(),
        ]);
    }
}
