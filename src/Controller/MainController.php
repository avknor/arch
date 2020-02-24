<?php


namespace App\Controller;


use App\Forms\Type\ArchiverType;
use App\Service\FileUploader;
use App\Service\PackerService;
use Domain\Archiver\Service\FileNamingService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param SessionInterface $session
     * @return Response
     * @throws Exception
     */
    public function index(Request $request, FileUploader $fileUploader, SessionInterface $session): Response
    {
        $form = $this->createForm(ArchiverType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file_list = $fileUploader->upload(...$form['attachment']->getData());
            if (!$file_list->isEmpty()) {
                $archiver = PackerService::concretePacker($form['archiveType']->getData());
                $archive = $archiver->pack($file_list, $this->getParameter('app.download_dir'));
                $session->set('archive-name', $archive->basename());

                return $this->redirectToRoute('download_page');
//                return $this->render('download.html.twig');
            }
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/download", name="download_page")
     * @return Response
     */
    public function downloadPage(): Response
    {
        return $this->render('download.html.twig');
    }

    /**
     * @Route("/get", name="download")
     * @param SessionInterface $session
     * @return Response
     * @throws Exception
     */
    public function download(SessionInterface $session): Response
    {
        $filename = $session->get('archive-name');
        $download_path = FileNamingService::provePath($this->getParameter('app.download_dir'));

        return new BinaryFileResponse($download_path . $filename);
    }
}