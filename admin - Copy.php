<?php
  session_start();
    $host="localhost";
    $dbname="bonbagay";
    $dbusername="root";
    $dbpassword="";
    $db=new PDO("mysql:host=".$host.";dbname=".$dbname,$dbusername,$dbpassword);$db->exec('SET NAMES utf8');

    $user=$db->prepare("SELECT * FROM user WHERE id_user=?");
    $user->execute(array($_SESSION['user']));
    $userinfo=$user->fetch();

  if(!isset($_SESSION['user']))
    {
      header("Location: login.php");
    }

  if(isset($_POST['ajouterclient']))
    {
      $insertionClient=$db->prepare("INSERT INTO `clients`(`numero`, `nom`, `prenom`, `adresse`, `codepostal`, `ville`, `pays`, `telephone`) VALUES(NULL, :nom, :prenom, :adresse, :codepostal, :ville, :pays, :telephone)");
      $insertionClient->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse'], 'codepostal' => $_POST['codepostal'], 'ville' => $_POST['ville'], 'pays' => $_POST['pays'], 'telephone' => $_POST['telephone']));
      header("Location: admin.php?action=4");
    }

  if(isset($_POST['modifierclient']))
    {
      $insertionClient=$db->prepare("UPDATE clients SET nom=:nom, prenom=:prenom, adresse=:adresse, codepostal=:codepostal, ville=:ville, pays=:pays, telephone=:telephone WHERE numero=:numero");
      $insertionClient->execute(array('nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'adresse' => $_POST['adresse'], 'codepostal' => $_POST['codepostal'], 'ville' => $_POST['ville'], 'pays' => $_POST['pays'], 'telephone' => $_POST['telephone'], 'numero' => $_GET['id']));
      header("Location: admin.php?action=4");
    }



  if(isset($_POST['ajouterarticle']))
    {
      $insertionArticle=$db->prepare("INSERT INTO `articles`(`reference`, `nom`, `description`, `prix`) VALUES(NULL, :nom, :description, :prix)");
      $insertionArticle->execute(array('nom' => $_POST['nom'], 'description' => $_POST['description'], 'prix' => $_POST['prix']));
      header("Location: admin.php?action=5");
    }

  if(isset($_POST['modifierarticle']))
    {
      $insertionArticle=$db->prepare("update articles set nom=:nom, description=:description, prix=:prix where reference=:reference");
      $insertionArticle->execute(array('nom' => $_POST['nom'], 'description' => $_POST['description'], 'prix' => $_POST['prix'], 'reference' => $_GET['id']));
      header("Location: admin.php?action=5");
    }

  if(isset($_POST['ajouterachat']))
    {
      $dateNow=date("Y/m/d");
      $insertionAchat=$db->prepare("INSERT INTO `achats`(`id_achat`, `id_client`, `id_article`, `quantite`, `date`) VALUES(NULL, :id_client, :id_article, :quantite, NOW())");
      $insertionAchat->execute(array('id_client' => $_POST['client'], 'id_article' => $_POST['article'], 'quantite' => $_POST['quantite']));
      header("Location: admin.php?action=6");
   }

  if(isset($_POST['modifierachat']))
    {
      $dateNow=date("Y/m/d");
      $insertionAchat=$db->prepare("update achats set id_client=:id_client, id_article=:id_article, quantite=:quantite where id_achat=:id_achat");
      $insertionAchat->execute(array('id_client' => $_POST['client'], 'id_article' => $_POST['article'], 'quantite' => $_POST['quantite'], 'id_achat' =>$_GET['id']));
      header("Location: admin.php?action=6");
    }



  if(isset($_POST['ajouteruser']))
    {
      $insertionuser=$db->prepare("INSERT INTO `user`(`id_user`, `name`, `username`, `password`, `type`) VALUES(NULL, :name, :username, :password, :type)");
      $insertionuser->execute(array('name' => $_POST['name'], 'username' => $_POST['username'], 'password' => $_POST['password'],'type' => $_POST['type']));
      header("Location: admin.php?action=11");
    }

  if(isset($_POST['modifieruser']))
    {
      $insertionuser=$db->prepare("update user set name=:name, username=:username, password=:password,type=:type where id_user=:id_user");
      $insertionuser->execute(array('name' => $_POST['name'], 'username' => $_POST['username'], 'password' => $_POST['password'], 'type' => $_POST['type'], 'id_user' => $_GET['id']));
      header("Location: admin.php?action=11");
    }

?>
  <!DOCTYPE html>
  <html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $userinfo['type'] ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="admin1.css">
  <style>
    .menue{
      margin-bottom: 30px;
      margin-left: 390px;
      padding-top: 20px;
     
     
      
     
    }
    .menue > a{
      text-decoration: none;
      padding-right: 20px;
    }
  </style>
</head>
<body>
   <section class="container-header">
      <header class="entete">
        <div class="container-header-line" >
          <!--<a href="#"><img class="logoApp" src="" alt="logos"></a>-->
          <a href="#">Etablisement Trucmuche S.A</a>
            <div class="user-info">
              <span class="type-user"><?php echo $userinfo['type'] ?></span> : <span><?php echo $userinfo['name'] ?></span>|
              <a href="logout.php" class="logout">Deconnection</a>
            </div>
        </div>   
      </header>
    </section>

    <div class="menue">
      <?php
      if($userinfo['type'] == "Vendeur")
      {
      ?>
      
        <a href='admin.php?action=1'>Ajouter Clients </a>
        <a href='admin.php?action=2'>Ajouter Article</a>
        <a href='admin.php?action=3'>Ajouter Achats</a>
        <a href='admin.php?action=4'>Afficher client</a>
        <a href='admin.php?action=5'>Afficher Article</a>
        <a href='admin.php?action=6'>Afficher Achat</a>
      
      <?php
          }
      ?>

      <?php
      if($userinfo['type'] == "Comptable" )
      {
      ?>
        <a href='admin.php?action=4'>Afficher client</a>
        <a href='admin.php?action=5'>Afficher Article</a>
        <a href='admin.php?action=6'>Afficher Achat</a>
      <?php
          }
      ?>

      <?php
      if($userinfo['type'] == "Admin" )
      {
      ?>
        <a href='admin.php?action=10'>Ajouter user</a>
        <a href='admin.php?action=1'>Ajouter Clients</a>
        <a href='admin.php?action=2'>Ajouter Article</a>
        <a href='admin.php?action=3'>Ajouter Achats</a>
        <a href='admin.php?action=11'>Afficher user</a>
        <a href='admin.php?action=4'>Afficher client</a>
        <a href='admin.php?action=5'>Afficher Article</a>
        <a href='admin.php?action=6'>Afficher Achat</a>
      <?php
          }
      ?>

  </div>

  <div class='admin-container'>

    <?php
    if(isset($_GET['action']) AND $_GET['action'] == 1)
    {
    ?>

    <div class='formulaire'>
      <form method='post' action=''>
    <h1>Ajouter Client</h1>
      <div class="form-group">
        <label>Nom</label>
        <input type="text" name='nom' class="form-control" placeholder="Nom" />
      </div>

      <div class="form-group">
        <label>Prénom</label>
        <input type="text" name='prenom' class="form-control" placeholder="Prénom" />
      </div>

      <div class="form-group">
        <label>Adresse</label>
        <textarea name="adresse" class="form-control" placeholder="Adresse" ></textarea>
      </div>

      <div class="form-group">
        <label>Code postal</label>
        <input type="text" name='codepostal' class="form-control" placeholder="Code postal" />
      </div>

      <div class="form-group">
        <label>Ville</label>
        <input type="text" name='ville' class="form-control" placeholder="Ville" />
      </div>

      <div class="form-group">
        <label>Pays</label>
        <select name="pays" class="form-control">
        <option>Pays</option>
        <option value="Afghanistan">France</option>
    </select>
      </div>

      <div class="form-group">
        <label>Téléphone</label>
        <input type="text" name='telephone' class="form-control" placeholder="Téléphone" />
      </div>

      <button type="submit" class="btn btn-primary" name='ajouterclient'>Ajouter</button>
    </form>
    </div>


      <?php
        }
          else if(isset($_GET['action']) AND $_GET['action'] == 2)
        {
      ?>

      <div class='formulaire'>
        <form method='post' action=''>
      <h1>Ajouter Article</h1>
        <div class="form-group">
          <label>Nom</label>
          <input type="text" name='nom' class="form-control" placeholder="Nom" />
        </div>

        <div class="form-group">
          <label>Description</label>
          <textarea name="description" class="form-control" placeholder="Description" ></textarea>
        </div>

        <div class="form-group">
          <label>Prix</label>
          <input type="number" name='prix' step="any" class="form-control" placeholder="Prix" />
        </div>

        <button type="submit" class="btn btn-primary" name='ajouterarticle'>Ajouter</button>
      </form>
      </div>


      <?php
        }
          else if(isset($_GET['action']) AND $_GET['action'] == 3)
        {
      ?>

        <div class='formulaire'>
            <form method='post' action=''>
          <h1>Ajouter Achat</h1>

          <div class="form-group">
              <label>Articles</label>
            <select name="article" class="form-control">
            <?php
            $queryarticle=$db->prepare("SELECT * FROM articles");
            $queryarticle->execute();
            while($row=$queryarticle->fetch())
            {
          echo "<option value='".$row['reference']."'>".$row['nom']."</option>";
            }
            ?>
            </select>
        </div>

        <div class="form-group">
        <label>Clients</label>
        <select name="client" class="form-control">
        <?php
        $queryClient=$db->prepare("SELECT * FROM clients");
        $queryClient->execute();
        while($client=$queryClient->fetch())
        {
        echo "<option value='".$client['numero']."'>".$client['nom']." ".$client['prenom']."</option>";  
        }
        ?>
        </select>
        </div>


        <div class="form-group">
          <label>Quantité</label>
          <input type="number" name='quantite' class="form-control" placeholder="Quantité" />
        </div>


        <button type="submit" class="btn btn-primary" name='ajouterachat'>Ajouter</button>
      </form>
      </div>
      <?php
      }
      else if(isset($_GET['action']) AND $_GET['action'] == 4)
      {
  ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Numero</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Adresse</th>
        <th>Code postal</th>
        <th>Ville</th>
        <th>Pays</th>
        <th>telephone</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
  <?php
  $queryShowCustomer=$db->prepare("SELECT * FROM clients");
  $queryShowCustomer->execute();
  while($client=$queryShowCustomer->fetch())
  {
  echo "<tr>";
  echo "<td>".$client['numero']."</td>";
  echo "<td>".$client['nom']."</td>";
  echo "<td>".$client['prenom']."</td>";
  echo "<td>".$client['adresse']."</td>";
  echo "<td>".$client['codepostal']."</td>";
  echo "<td>".$client['ville']."</td>";
  echo "<td>".$client['pays']."</td>";
  echo "<td>".$client['telephone']."</td>";
  if($userinfo['type']!="Comptable")
  {
    echo "<td><a href='admin.php?action=7&&id=".$client['numero']."'><button class='btn btn-primary'>Modifier</button></a></td>";
  }
  else{
    echo"<td></td>";
  }
  
  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 5)
  {
  ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>reference</th>
        <th>Nom</th>
        <th>Desciption</th>
        <th>Prix</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
  <?php
  $queryShowItem=$db->prepare("SELECT * FROM articles");
  $queryShowItem->execute();
  while($item=$queryShowItem->fetch())
  {
  echo "<tr>";
  echo "<td>".$item['reference']."</td>";
  echo "<td>".$item['nom']."</td>";
  echo "<td>".$item['description']."</td>";
  echo "<td>".$item['prix']." Dollars</td>";
  if($userinfo['type']!="Comptable")
  {
    echo"<td><a href='admin.php?action=8&&id=".$item['reference']."'><button class='btn btn-primary'>Modifier</button></a></td>";
  }
  else{
    echo"<td></td>";
  }
  
  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 6)
  {
  ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Numero</th>
        <th>Client</th>
        <th>Article</th>
        <th>Quantité</th>
        <th>Date</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
  <?php
  $queryShowPurchase=$db->prepare("SELECT * FROM achats");
  $queryShowPurchase->execute();
  while($item=$queryShowPurchase->fetch())
  {
  echo "<tr>";
  echo "<td>".$item['id_achat']."</td>";

  $queryclient=$db->prepare("SELECT * FROM clients WHERE numero=?");
  $queryclient->execute(array($item['id_client']));
  $client=$queryclient->fetch();

  echo "<td>".$client['nom']." ".$client['prenom']."</td>";

  $queryitem=$db->prepare("SELECT * FROM articles WHERE reference=?");
  $queryitem->execute(array($item['id_article']));
  $article=$queryitem->fetch();
  echo "<td>".$article['nom']."</td>";

  echo "<td>".$item['quantite']."</td>";
  if($userinfo['type']!="Comptable")
  {
    echo"<td><a href='admin.php?action=9&&id=".$item['id_achat']."'><button class='btn btn-primary'>Modifier</button></a></td>";
  }
  else{
    echo"<td></td>";
  }
  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 7)
  {
  $queryclient=$db->prepare("SELECT * FROM clients WHERE numero=?");
  $queryclient->execute(array($_GET['id']));
  $client=$queryclient->fetch();
  ?>

  <div class='formulaire'>
    <form method='post' action=''>
  <h1>Modifier Client</h1>
    <div class="form-group">
      <label>Nom</label>
      <input type="text" name='nom' class="form-control" placeholder="Nom" value="<?php echo $client['nom']; ?>" />
    </div>

    <div class="form-group">
      <label>Prénom</label>
      <input type="text" name='prenom' class="form-control" placeholder="Prénom" value="<?php echo $client['prenom']; ?>" />
    </div>

    <div class="form-group">
      <label>Adresse</label>
      <textarea name="adresse" class="form-control" placeholder="Adresse" ><?php echo $client['adresse']; ?></textarea>
    </div>

    <div class="form-group">
      <label>Code postal</label>
      <input type="text" name='codepostal' class="form-control" placeholder="Code postal" value="<?php echo $client['codepostal']; ?>" />
    </div>

    <div class="form-group">
      <label>Ville</label>
      <input type="text" name='ville' class="form-control" placeholder="Ville" value="<?php echo $client['ville']; ?>" />
    </div>

    <div class="form-group">
      <label>Pays</label>
      <select name="pays" class="form-control">
      <option value="<?php echo $client['pays']; ?>"><?php echo $client['pays']; ?></option>
      <option value="France">France</option>
      <option value="USA">USA</option>
      <option value="Canada">Canada</option>
  </select>
    </div>

    <div class="form-group">
      <label>Téléphone</label>
      <input type="text" name='telephone' class="form-control" placeholder="Téléphone" value="<?php echo $client['telephone']; ?>"  />
    </div>

    <button type="submit" class="btn btn-primary" name='modifierclient'>Modifier</button>
  </form>
  </div>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 8)
  {
  $queryarticle=$db->prepare("SELECT * FROM articles WHERE reference=?");
  $queryarticle->execute(array($_GET['id']));
  $article=$queryarticle->fetch();
  ?>

  <div class='formulaire'>
    <form method='post' action=''>
  <h1>Modifier Article</h1>
    <div class="form-group">
      <label>Nom</label>
      <input type="text" name='nom' class="form-control" placeholder="Nom" value='<?php echo $article['nom'] ?>'/>
    </div>

    <div class="form-group">
      <label>Description</label>
      <textarea name="description" class="form-control" placeholder="Description" ><?php echo $article['description'] ?></textarea>
    </div>

    <div class="form-group">
      <label>Prix</label>
      <input type="number" name='prix' step="any" class="form-control" placeholder="Prix" value='<?php echo $article['prix'] ?>'/>
    </div>

    <button type="submit" class="btn btn-primary" name='modifierarticle'>Modifier</button>
  </form>
  </div>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 9)
  {
  $queryachat=$db->prepare("SELECT * FROM achats WHERE id_achat=?");
  $queryachat->execute(array($_GET['id']));
  $achat=$queryachat->fetch();
  ?>

  <div class='formulaire'>
    <form method='post' action=''>
  <h1>Modifier Achat</h1>

  <div class="form-group">
      <label>Articles</label>
    <select name="article" class="form-control" >
    <?php
    $queryarticle=$db->prepare("SELECT * FROM articles");
    $queryarticle->execute();
    while($row=$queryarticle->fetch())
    {
  if($row['reference'] == $achat['id_article'])
  {
  echo "<option value='".$row['reference']."' selected>".$row['nom']."</option>";
  }
  else
  {
    echo "<option value='".$row['reference']."'>".$row['nom']."</option>";
  }

    }
    ?>
    </select>
    </div>

    <div class="form-group">
    <label>Clients</label>
    <select name="client" class="form-control">
    <?php
    $queryClient=$db->prepare("SELECT * FROM clients");
    $queryClient->execute();
    while($client=$queryClient->fetch())
    {
  if($client['numero'] == $achat['id_client'])
  {
    echo "<option value='".$client['numero']."' selected>".$client['nom']." ".$client['prenom']."</option>"; 
  }
  else{
    echo "<option value='".$client['numero']."'>".$client['nom']." ".$client['prenom']."</option>"; 
  }
    
    }
    ?>
    </select>
    </div>


    <div class="form-group">
      <label>Quantité</label>
      <input type="number" name='quantite' class="form-control" placeholder="Quantité" value="<?php echo $achat['quantite']; ?>" />
    </div>


    <button type="submit" class="btn btn-primary" name='modifierachat'>Modifier</button>
  </form>
  </div>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 10)
  {
  ?>

  <div class='formulaire'>
    <form method='post' action=''>
  <h1>Ajouter User</h1>
    <div class="form-group">
      <label>Nom</label>
      <input type="text" name='name' class="form-control" placeholder="name" />
    </div>

    <div class="form-group">
      <label>Nom d'utilisateur</label>
      <input name="username" class="form-control" placeholder="username" />
    </div>

    <div class="form-group">
      <label>Mot de Passe</label>
      <input type="text" name='password'  class="form-control" placeholder="password" />
    </div>
    <div class="form-group">
      <label>Type d'utilisateur</label>
      <select name="type" class="form-control"">
        <option value="vendeur">Vendeur</option>
        <option value="comptable">Comptable</option>
        <option value="administrateur">Administrateur</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary" name='ajouteruser'>Ajouter</button>
  </form>
  </div>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 11)
  {
  ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th>Numero</th>
        <th>Nom et Prenom</th>
        <th>Nom utilisateur</th>
        <th>Mot de passe</th>
        <th>Type</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
  <?php
  $queryShowuser=$db->prepare("SELECT * FROM user");
  $queryShowuser->execute();
  while($user=$queryShowuser->fetch())
  {
  echo "<tr>";
  echo "<td>".$user['id_user']."</td>";
  echo "<td>".$user['name']."</td>";
  echo "<td>".$user['username']."</td>";
  echo "<td>".$user['password']." </td>";
  echo "<td>".$user['type']." </td>";
  echo"<td><a href='admin.php?action=12&&id=".$user['id_user']."'><button class='btn btn-primary'>Modifier</button></a></td>";
  echo "</tr>";
  }
  ?>
  </tbody>
  </table>
  <?php
  }
  else if(isset($_GET['action']) AND $_GET['action'] == 12)
  {
  $queryarticle=$db->prepare("SELECT * FROM user WHERE id_user=?");
  $queryarticle->execute(array($_GET['id']));
  $article=$queryarticle->fetch();
  ?>

  <div class='formulaire'>
    <form method='post' action=''>
  <h1>Modifier user</h1>
    <div class="form-group">
      <label>Nom</label>
      <input type="text" name='name' class="form-control" placeholder="Nom" value='<?php echo $article['name'] ?>'/>
    </div>

    <div class="form-group">
      <label>Nom utilisateur</label>
      <input type="text" name='username'  class="form-control" placeholder="nom utilisateur" value='<?php echo $article['username'] ?>'/>
    </div>

    <div class="form-group">
      <label>Mot de passe</label>
      <input type="text" name='password'  class="form-control" placeholder="Mot de passe" value='<?php echo $article['password'] ?>'/>
    </div>

    <div class="form-group">
      <label>Type</label>
      <input type="text" name='type'  class="form-control" placeholder="type" value='<?php echo $article['type'] ?>'/>
    </div>

    <button type="submit" class="btn btn-primary" name='modifieruser'>Modifier</button>
  </form>
  </div>
  <?php
  }
  ?>
    </div>

  </body>
  </html>