<?php

namespace App\Controller;

use Facebook\WebDriver\Chrome\ChromeDriver;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Panther\Client;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        $client = Client::createChromeClient(null, [
            "--headless",
            "--window-size=1400,900",
            "--disable-gpu",
            "--auto-open-devtools-for-tabs",
            "--host-rules 'MAP linkonbiz.com 0.0.0.0'"
        ]);

        $client->request('GET', 'https://linkonbiz.com');
        $screenshotImageWithBase64 = base64_encode($client->takeScreenshot());

        $client->close();

        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
            'screenshot_image' => $screenshotImageWithBase64
        ]);
    }
}
