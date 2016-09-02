<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $texto = "Listagem de imóveis";
        $dados = ["texto" => $texto];
        return $this->render("imovel/lista.html.twig", $dados);
    }

    /**
     * @Route("/imovel/form", name="imovel_form")
     */
    public function formAction() {
        return $this->render("imovel/form.html.twig");
    }

    /**
     * @Route("/imovel/save", name="imovel_save")
     */
    public function saveAction(Request $request) {

        $imovel = new Imovel();
        $imovel->setTitulo($request->get("titulo"));
        $imovel->setTamanho($request->get("tamanho"));
        $imovel->setPreco($request->get("preco"));
        $imovel->setTipo($request->get("tipo"));

        $em = $this->getDoctrine()->getManager();
        $em->persist($imovel);
        $em->flush();

        return $this->redirectToRoute("homepage");

    }


}
