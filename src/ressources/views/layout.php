<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/main.css" rel="stylesheet">
    <link href="/fontawesome/css/all.css" rel="stylesheet">
    <title>ExerciseLooper</title>
</head>
<body>
    <header class="<?= $headerClass; ?>">
        <a href="/">
            <img src="/images/logo.png" alt="logo">
        </a>
        <?= $header; ?>
    </header>

    <div class="container-main">
        <?= $content; ?>
    </div>
</body>
</html>