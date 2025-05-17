<?php 
            session_start();
            $uti = $_SESSION['id'];
            $fichier = 'utilisateurs.json';
            $nom = $prenom = $telephone = $email = $password = $civilite = "";

            $maj = false;

            if (file_exists($fichier)){
                $contenu_fichier = file_get_contents($fichier);
                $tab_utilisateur = json_decode($contenu_fichier, true);

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $json = file_get_contents('php://input');
                    $nv_utilisateur = json_decode($json, true);
                
                    foreach ($tab_utilisateur['utilisateurs'] as &$utilisateur) {
                        if ($utilisateur['id'] == $uti) {
                            if (isset($nv_utilisateur['nom']) && (trim($nv_utilisateur['nom']) != trim($utilisateur['nom']))){
                                $utilisateur['nom'] = trim($nv_utilisateur['nom']);
                                $maj = true;
                            }
                            if (isset($nv_utilisateur['prenom']) && (trim($nv_utilisateur['prenom']) != trim($utilisateur['prenom']))){
                                $utilisateur['prenom'] = trim($nv_utilisateur['prenom']);
                                $maj = true;
                            }
                            if (isset($nv_utilisateur['telephone']) && (trim($nv_utilisateur['telephone']) != trim($utilisateur['telephone']))){
                                $utilisateur['telephone'] = trim($nv_utilisateur['telephone']);
                                $maj = true;
                            }
                            if (isset($nv_utilisateur['email']) && (trim($nv_utilisateur['email']) != trim($utilisateur['email']))){
                                $utilisateur['email'] = trim($nv_utilisateur['email']);
                                $maj = true;
                            }
                            if (isset($nv_utilisateur['password']) && (trim($nv_utilisateur['password']) != trim($utilisateur['password']))){
                                $utilisateur['password'] = trim($nv_utilisateur['password']);
                                $maj = true;
                            }
                            break;
                        }
                    }

                    if($maj){
                        header('Content-Type: application/json');
                        $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                        file_put_contents($fichier, $fichier_encode);

                        echo json_encode(["status" => "success",
                            "utilisateur" => [
                                "nom" => $utilisateur['nom'],
                                "prenom" => $utilisateur['prenom'],
                                "telephone" => $utilisateur['telephone'],
                                "email" => $utilisateur['email'],
                                "password" => $utilisateur['password']
                            ]
                        ]);
                        exit;
                    }
                    else{
                        echo json_encode(["status" => "failed"]);
                        exit;
                    }
                }

                foreach ($tab_utilisateur['utilisateurs'] as $utilisateur) {
                    if ($utilisateur['id'] == $uti) {
                        $civilite = $utilisateur['civilite'];
                        $nom = $utilisateur['nom'];
                        $prenom = $utilisateur['prenom'];
                        $telephone = $utilisateur['telephone'];
                        $email = $utilisateur['email'];
                        $password = $utilisateur['password'];
                        break;
                    }
                }
            }
            
        ?>