<?php include('src/view/header.php') ?>

<section>
    <header>
        <h1>Devoirs à faire</h1>
        <form action="" method="get">
            <input type="hidden" name="action" value="list_tasks">
            <select name="domain_id" required>
                <option value="0">Toutes les matières</option>
                <?php foreach ($domains as $domain) : ?>
                    <?php if ($domain_id == $domain['id']) : ?>
                        <option value="<?= $domain['id'] ?>" selected>
                        <?php else : ?>
                        <option value="<?= $domain['id'] ?>">
                        <?php endif ?>
                        <?= $domain['name'] ?> </option>

                    <?php endforeach ?>
            </select>
            <button type="submit">Filtrer</button>
        </form>
    </header>

    <?php if ($tasks) : ?>
        <?php foreach ($tasks as $task) : ?>
            <div class="row">
                <div class="item">
                    <p class="name"> <?= $task['name'] ?> </p>
                    <p class="description"> <?= $task['description'] ?> </p>
                </div>
                <div class="delete">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_task">
                        <input type="hidden" name="task_id" value=" <?= $task['id'] ?> ">
                        <button class="delete__button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach ?>

    <?php else : ?>
        <?php if ($domain_id) : ?>
            <p>Il n'y a pas encore de devoir dans cette matière.</p>
        <?php else : ?>
            <p>Il n'y a pas encore de devoir.</p>
        <?php endif ?>
    <?php endif ?>
</section>

<section class="add">
    <h2>Ajouter un devoir</h2>

    <form action="." method="post">
        <input type="hidden" name="action" value="add_task">
        <div class="add__imput">
            <label for="domain_id">Matière</label>
            <select name="domain_id" required>
                <option value="">Choissisez une matière</option>
                <?php foreach ($domains as $domain) : ?>
                    <option value=" <?= $domain['id'] ?> "> <?= $domain['name'] ?> </option>
                <?php endforeach ?>
            </select>

            <label for="task_descritpion">Contenu du devoir</label>
            <input type="text" name="task_description" maxlength="120" placeholder="Faire l'exercice numéro ..." required>
        </div>
        <button class="add__button">Ajouter</button>
    </form>
</section>

<p><a href=".?action=list_domain">Modifier les matières</a></p>

<?php include('src/view/footer.php') ?>