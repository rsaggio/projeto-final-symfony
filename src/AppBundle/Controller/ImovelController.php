<?php

namespace AppBundle\Controller;

use AppBundle\Form\CadastroImovelForm;
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
        $imovelRepository = $this->getDoctrine()->getRepository("AppBundle:Imovel");
        $imovel = new Imovel();
        $imovel->setTitulo($request->get("titulo"));
        $imovel->setTamanho($request->get("tamanho"));
        $imovel->setPreco($request->get("preco"));
        $imovel->setTipo($request->get("tipo"));

        $imoveis = $imovelRepository->save($imovel);

        return $this->redirectToRoute("homepage");

    }


}
