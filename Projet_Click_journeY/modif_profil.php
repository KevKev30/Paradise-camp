<?php 
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
                            if (!empty($nv_utilisateur['nom']) && ($nv_utilisateur['nom'] != $utilisateur['nom'])){
                                $utilisateur['nom'] = $nv_utilisateur['nom'];
                                $maj = true;
                            }
                            if (!empty($nv_utilisateur['prenom']) && ($nv_utilisateur['prenom'] != $utilisateur['prenom'])){
                                $utilisateur['prenom'] = $nv_utilisateur['prenom'];
                                $maj = true;
                            }
                            if (!empty($nv_utilisateur['telephone']) && ($nv_utilisateur['telephone'] != $utilisateur['telephone'])){
                                $utilisateur['telephone'] = $nv_utilisateur['telephone'];
                                $maj = true;
                            }
                            if (!empty($nv_utilisateur['email']) && ($nv_utilisateur['email'] != $utilisateur['email'])){
                                $utilisateur['email'] = $nv_utilisateur['email'];
                                $maj = true;
                            }
                            if (!empty($nv_utilisateur['password']) && ($nv_utilisateur['password'] != $utilisateur['password'])){
                                $utilisateur['password'] = $nv_utilisateur['password'];
                                $maj = true;
                            }
                            break;
                        }
                    }

                    if($maj){
                        header('Content-Type: application/json');
                        $fichier_encode = json_encode($tab_utilisateur, JSON_PRETTY_PRINT);
                        file_put_contents($fichier, $fichier_encode);

                        echo json_encode(["status" => "success"]);
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