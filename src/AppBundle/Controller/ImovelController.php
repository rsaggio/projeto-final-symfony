<?php

namespace AppBundle\Controller;

use AppBundle\Form\CadastroImovelForm;
use AppBundle\Service\UploadFileService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Imovel;

/**
 * Class ImovelController
 * @package AppBundle\Controller
 */
class ImovelController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $imovelRepository = $this->getDoctrine()->getRepository("AppBundle:Imovel");
        $imoveis = $imovelRepository->findAll();
        $dados = ["imoveis" => $imoveis];
        return $this->render("imovel/lista.html.twig", $dados);
    }

    /**
     * @Route("/imovel/form", name="imovel_form")
     */
    public function formAction() {
        $form = $this->createForm(CadastroImovelForm::class);
        $dados = ["form" => $form->createView()];
        return $this->render("imovel/form.html.twig",$dados);
    }

    /**
     * @Route("/imovel/save", name="imovel_save")
     * @Method("Post");
     */
    public function saveAction(Request $request) {

        $form = $this->createForm(CadastroImovelForm::class);
        $form->handleRequest($request);
        $imovelRepository = $this->getDoctrine()->getRepository("AppBundle:Imovel");

        if($form->isSubmitted() && $form->isValid()) {

            $imovel = $form->getData();

            $foto = $imovel->getFoto();

            /* Extrair para parâmetro mais para frente na parte de injeção de dependencia */
            $diretorio = $this->get('kernel')->getRootDir()."\..\web\uploads";

            $service = new UploadFileService($diretorio);
            $caminho = $service->upload($foto);
            $imovel->setFoto($caminho);

            $imovelRepository->save($imovel);

            $this->addFlash('notice', 'Imovel anunciado com sucesso');

            return $this->redirectToRoute('homepage');
        }

        return $this->render("imovel/form.html.twig", ["form" => $form->createView()]);

    }


}
