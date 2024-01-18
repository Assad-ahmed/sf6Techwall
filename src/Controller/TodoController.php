<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function mysql_xdevapi\getSession;
#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route('/', name: 'app_todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher notre tableau de todo
        //sinon je l'initialiser puis l'affiche

        if (!$session->has('todos')) {
            $todos = [
                'achat' => 'acheter cle usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'corriger mes examens'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste viens d'etre initialisee");
        }
        //si j'ai mon tableau de todo dans mon session  je ne fait que l'afficher

        return $this->render('todo/index.html.twig.',);
    }

    #[Route('/add/{name?test}/{content?Hadjira}', name: 'add_todo')]
    public function addTodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        //verifier si  j'ai mon tableau de todo  dans la session
        if ($session->has('todos')){
            //si oui
            $todos=$session->get('todos');
            // verfier si on a deja todo avec la meme name
            if (isset($todos[$name])){

                // si oui afficher errer
                $this->addFlash('error', "le todo d'id $name existe deja dans la liste");
            }else{
                //sinon  on l'ajoute on  affihe un message de succes
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo d'id $name a ete ajoute avec succes");

            }

        }else{
            //si non
            // affiche une errer et on vas rediriger vers les controller index
            $this->addFlash('error', "La liste de todo n'est pas encore initilalisee");

        }
    return $this->redirectToRoute('app_todo');

    }
    #[Route('/update/{name}/{content}', name: 'update_todo')]
    public function updateTodo(Request $request, $name, $content):RedirectResponse
    {
        $session = $request->getSession();
        //verifier si  j'ai mon tableau de todo  dans la session
        if ($session->has('todos')){
            //si oui
            $todos=$session->get('todos');
            // verfier si on a deja todo avec la meme name
            if (!isset($todos[$name])){

                // si oui afficher errer
                $this->addFlash('error', "le todo d'id $name n' existe pas dans  la liste");
            }else{
                //sinon  on l'ajoute on  affihe un message de succes
                $todos[$name] = $content;
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo d'id $name a ete modifie avec succes");

            }

        }else{
            //si non
            // affiche une errer et on vas rediriger vers les controller index
            $this->addFlash('error', "La liste de todo n'est pas encore initilalisee");

        }
        return $this->redirectToRoute('app_todo');

    }

    #[Route('/delete/{name}', name: 'delete_todo')]
    public function deleteTodo(Request $request, $name):RedirectResponse
    {
        $session = $request->getSession();
        //verifier si  j'ai mon tableau de todo  dans la session
        if ($session->has('todos')){
            //si oui
            $todos=$session->get('todos');
            // verfier si on a deja todo avec la meme name
            if (!isset($todos[$name])){

                // si oui afficher errer
                $this->addFlash('error', "le todo d'id $name n' existe pas dans  la liste");
            }else{
                //sinon  on l'ajoute on  affihe un message de succes
               unset($todos[$name]);
                $session->set('todos', $todos);
                $this->addFlash('success', "le todo d'id $name a ete supprime avec succes");

            }

        }else{
            //si non
            // affiche une errer et on vas rediriger vers les controller index
            $this->addFlash('error', "La liste de todo n'est pas encore initilalisee");

        }
        return $this->redirectToRoute('app_todo');

    }

    #[Route('/reset', name: 'reset_todo')]
    public function resetTodo(Request $request):RedirectResponse
    {
        $session = $request->getSession();
        $session->remove('todos');
        return $this->redirectToRoute('app_todo');

    }




}
