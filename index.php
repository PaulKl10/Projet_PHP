<?php
require_once 'layout/header.php';
?>


<h1 class="text-center text-warning mt-5">Bienvenue sur Oh my count</h1>
<p class="text-center text-warning mt-4">Une application web permettant de recenser tous vos films, séries et animés !</p>
<?php
if(isset($_GET['error'])){?>
    <div class="alert alert-danger w-50 m-auto text-center">
<?php switch ($_GET['error']) {
        case "1":
            echo "Rien n'a été entré";
            break;
        
        case "2":
            echo "L'utilisateur n'est pas enreigstré";
            break;

        case "3":
            echo "Vous n'êtes pas connecté";
            break;
        case "4":
            echo "Le pseudo entré existe déjà";
            break;
    }?>
    </div>
<?php    
}
?>
<?php
if(isset($_GET['success'])){?>
    <div class="alert alert-success w-50 m-auto text-center">
<?php switch ($_GET['success']) {
        case "1":
            echo "L'enregistrement est réussi";
            break;
    }?>
    </div>
<?php    
}
?>
<div class="w-25 m-auto mt-5">
    <form action="login.php" method="POST">
        <div class="form-floating mb-3">
          <input required type="text" name="pseudo" class="form-control bg-black text-white" id="floatingInput" placeholder="name@example.com">
          <label class="text-warning" for="floatingInput">Pseudo</label>
        </div>
        <div class="form-floating">
          <input required type="password" name="mdp" class="form-control bg-black text-white" id="floatingPassword" placeholder="Password">
          <label class="text-warning" for="floatingPassword">Password</label>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-warning text-white fw-bold mb-3">Confirm identity</button>
        </div>
    </form>
   <!-- Button trigger modal -->
    <div class="m-auto d_block text-center">
        <a type="button" class="text-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Pas encore inscris ?
        </a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">S'inscire</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="POST">
                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control" name="pseudo" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Pseudo</label>
                    </div>
                    <div class="form-floating">
                        <input required type="password" name="mdp" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">S'enregistrer</button>
            </div>
                </form>
        </div>
    </div>
</div>
<?php
require_once 'layout/footer.php';
