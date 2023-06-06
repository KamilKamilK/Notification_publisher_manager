<?php
declare(strict_types=1);

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasicController extends AbstractController
{
    #[Route('/', name: 'app_basic_path')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        $email = $this->getUser()->getUserIdentifier();

        return $this->render('basic/index.html.twig', [
            'email' => $email,
        ]);
    }
}
