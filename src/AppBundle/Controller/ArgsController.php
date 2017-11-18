<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ConsoleType;
use AppBundle\Args\Args;

class ArgsController extends Controller
{
    /**
     * @Route("/index", name="index")
     */
    public function indexAction(Request $request)
    {
        $inputPattern = '-l true -p 234 -d Ala';
        $commandInput = false;

        $form = $this->createForm(ConsoleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = $form->getData();
            $commandInput = $command->getCommandInput();
        }

        $schema = "l,p#,d*";
        $command = '-l true -p 234 -d Ala';
        $args = new Args($schema, $command);

        return $this->render('args/index.html.twig', [
            'inputPattern' => $inputPattern,
            'form' => $form->createView(),
            'commandInput' => $commandInput,
        ]);
    }
}

