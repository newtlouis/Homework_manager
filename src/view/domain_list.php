<?php 
include('src/view/header.php') 
?>

<h1>Liste des matières</h1>

<?php if ($domains) : ?>
    <section>
        <?php foreach ($domains as $domain) : ?>
            <div class="row">
                <div class="item">
                    <p class="domain__name"> <?= $domain['name'] ?> </p>
                </div>
                <div class="delete">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_domain">
                        <input type="hidden" name="domain_id" value=" <?= $domain['id'] ?> ">
                        <button class="delete__button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>
    </section>
<?php else : ?>
    <p>Aucune matière enregistrée.</p>
<?php endif ?>

<section class="add">
    <h2>Ajouter une matière</h2>
    <form action="." method="post">
        <input type="hidden" name="action" value="add_domain">
        <div class="add__input">
            <label for="domain_name">Intitulé de la matière</label>
            <input type="text" name="domain_name" maxlength="50" placeholder="Français" autofocus required>
        </div>

        <button class="add__button">Ajouter</button>
    </form>
</section>

<p><a href=".">Voir ou ajouter des devoirs</a></p>

<?php include('src/view/footer.php') ?>