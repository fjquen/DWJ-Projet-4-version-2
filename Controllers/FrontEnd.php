<?php

class FrontEnd
{
    private $billetRepository;
    private $commentRepository;

    public function __construct(BilletRepository $billetRepository, CommentRepository $commentRepository)
    {
        $this->billetRepository = $billetRepository;
        $this->commentRepository = $commentRepository;
    }

    public function indexBillets(): array
    {
        $billets = $this->billetRepository->getBillets();
        $comments = $this->commentRepository->getComments();

        return [
            'views' => __DIR__ . '/../Views/Billetvue.php',
            'billets' => $billets,
            'comments' => $comments,

        ];
    }

    public function afficheBilletSimple(): array
    {
        $idBillet = $_GET['idBillet'];

        $billet = $this->billetRepository->getBillet($idBillet);
        $comments = $this->commentRepository->getCommentsbyIdBillet($idBillet);

        return [
            'views' => __DIR__ . '/../Views/Billetsimple.php',
            'billet' => $billet,
            'comments' => $comments,
        ];
    }

    public function ajouteCommentaire()
    {
        $idBillet = $_GET["idBillet"];
        $pseudo = $_POST["pseudo"];
        $commentaire = $_POST["commentaire"];
        $secretKey = "6LeVc74UAAAAAJofKaxwWA765BPaoxJIBRzQBLmh";
        $ip = $_SERVER['REMOTE_ADDR'];
        // post request to server
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($_POST['g-recaptcha-response']);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if (empty($pseudo) || empty($commentaire) || empty($_POST['g-recaptcha-response'])) {

            return $this->afficheBilletSimple();
           
   

            
        } elseif($responseKeys["success"]) {
            $this->commentRepository->addCommentsbyIdBillet($idBillet, $pseudo, $commentaire);

            header('Location: index.php?controller=billet&action=afficheBilletSimple&idBillet=' . $idBillet . '#pseudo');
         
        }
    }

    public function accueilLogin()
    {
        return [
            'views' => __DIR__ . '/../Views/Adminloginview.php',
        ];
    }

    public function error404()
    {
        return [
            'views' => __DIR__ . '/../Views/404.php',
        ];
    }

    public function commentReported()
    {
        $idComment = isset($_GET['idComment']) ? $_GET['idComment'] : NULL;
        $commentReported = $this->commentRepository->reportComment($idComment);
        $comment = $this->commentRepository->getComments($idComment);

        return [
            'views' => __DIR__ . '/../Views/ReportCommentView.php',
            'commentReported' => $commentReported,
            'comment' => $comment,
        ];
    }
}
