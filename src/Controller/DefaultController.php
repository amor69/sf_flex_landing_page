<?php
/**
 * Created by PhpStorm.
 * User: amor3
 * Date: 22/09/17
 * Time: 10:00
 */

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class DefaultController extends Controller
{
    /** @var array The full configuration of the current entity */
    protected $entity = array();
    /**
     * @Route(path="/", name="home")
     * @return JsonResponse
     */
    public function index()
    {
        return $this->render('layout/index.html.twig');
    }

    /**
     * @Route(path="/contact", name="contact")
     * @param EntityManager $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function contact(EntityManager $em, Request $request)
    {
        $contact = new Contact();
        
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em->persist($contact);
            $em->flush();
            //$this->addFlash("notice","Formulaire enregistré .");
            
            return $this->redirectToRoute('home');
        }

        return $this->render('form/contact.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
