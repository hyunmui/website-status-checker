<?php

namespace App\Controller;

use App\Test;
use Aws\Credentials\Credentials;
use Aws\Ec2\Ec2Client;
use Aws\S3\S3Client;
use Doctrine\Common\Collections\ArrayCollection;
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

    #[Route('/aws/s3', name: 'app_service_s3')]
    public function awsS3(S3Client $client): Response
    {
        dump($client);

        $response = $client->putObject([
            'ACL' => 'public-read',
            'Bucket' => 'esang-mim-dev',
            'Key' => 'server-check-screenshots/test.png',
            'Body' => file_get_contents('https://d3ib83x3z60m0e.cloudfront.net/wp-content/uploads/2019/12/05104207/es_ci_%402.png'),
            'ContentType' => 'image/png'
        ]);

        dump($response);

        return $this->render('service/aws.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/aws/ec2', name: 'app_service_ec2')]
    public function awsEc2(Ec2Client $client): Response
    {
        $response = $client->describeInstances([
            'Filters' => [
                [
                    'Name' => 'tag:Name',
                    'Values' => ['LinkOn-Main', 'LinkOn-Spot-AutoGen'],
                ],
                [
                    'Name' => 'instance-state-name',
                    'Values' => ['running'],
                ],
            ]
        ]);

        $collection = new ArrayCollection($response->get('Reservations'));
        $publicIps = $collection->map(fn (array $ec) => $ec['Instances'][0]['PublicIpAddress'])->toArray();
        dump($response, $collection->map(fn (array $ec) => $ec['Instances'][0]['PublicIpAddress']));

        return $this->render('service/aws.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }
}
