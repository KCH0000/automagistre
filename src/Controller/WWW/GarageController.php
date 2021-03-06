<?php

declare(strict_types=1);

namespace App\Controller\WWW;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/garage")
 */
final class GarageController extends AbstractController
{
    /**
     * @Route(name="garage_index")
     */
    public function index(): Response
    {
        return $this->render('www/garage/index.html.twig');
    }
}
