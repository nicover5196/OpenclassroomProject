<?php
    $idMessage = null;
    if(!empty($_POST['submit']))
        {
            $idMessage = $_POST['submit'];
        }
?>
<!DOCTYPE html>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
        <title>GBAF</title>
    </head>
    <body>

        <header>
            <a href="index.php"><img src="img_css/gbaf_logo.png"></a>
            <h1>Le Groupement Banque Assurance Français</h1>
        </header>

<!-- Enregistrement des données formulaire -->

        <section>
            
            <div class="registre">

                 <h2>Inscription</h2>

                    <form method="post" action="registre_post.php">

                        <label>Nom                          </label> :  </br> <input required type="text" name="nom" size="50%" />               </br>
                        <label>Prénom                       </label> :  </br> <input required type="text" name="prenom" size="50%" />            </br>
                        <label>Nom d'utilisateur            </label> :  </br> <input required type="text" name="username" size="50%" />          </br>
                        <label>Mot de passe                 </label> :  </br> <input required type="password" name="password" size="50%" />      </br>
                        <label>Question secrète             </label> :  </br> <input required type="text" name="question" size="50%" />   </br>
                        <label>Réponse secrète              </label> :  </br> <input required type="password" name="reponse" size="50%" /></br>

                        <button type="submit" name="submit">S'enregistrer </button>

                </div>

            </form>

        </section>
        
<!-- Pied de page -->

        <?php require_once 'footer.php'; ?>

    </body>
</html>