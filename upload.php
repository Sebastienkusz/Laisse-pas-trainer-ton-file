<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/check.php" method="post" enctype="multipart/form-data">
        <input type="file" name="files[]" multiple>
        <input type="submit" value="Envoie de(s) fichier(s)">
    </form>

<?php $it = new FilesystemIterator(dirname(__FILE__) . '/uploads'); ?>
    <figure>
        <?php foreach ($it as $fileInfo) : ?>
            <img src="/uploads/<?= $fileInfo->getFilename() ?>" alt="<?= $fileInfo->getFilename() ?>" width="300px" height="auto">
            <figcaption>
            <?= $fileInfo->getFilename() . "<br>"; ?>
            </figcaption>
            <form action="/delete.php" method="post">
                <input type="hidden" value="<?= $fileInfo->getFilename(); ?>" name="deleteFile">
                <button>Delete</button>
            </form>
        <?php endforeach; ?>
    </figure>

</body>
</html>