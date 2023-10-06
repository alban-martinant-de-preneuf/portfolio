<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alban Martinant de Préneuf</title>

    <!-- owlcarousel -->
    <link href="styles/owl.theme.default.min.css" rel="stylesheet">
    <link href="styles/owl.carousel.min.css" rel="stylesheet">
    <script src="scripts/jquery-3.7.1.min.js"></script>
    <script src="scripts/owl.carousel.min.js"></script>

    <!-- fontawesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- googlefont -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&display=swap" rel="stylesheet">

    <!-- tailwind  -->
    <link href="dist/output.css" rel="stylesheet">

    <!-- scripts -->
    <script src="scripts/script.js" defer></script>
    <script src="scripts/carousel.js" defer></script>

    <script src="https://kit.fontawesome.com/247a482759.js" crossorigin="anonymous"></script>
</head>

<body class="relative">
    <?php
    include_once("includes/header.php");
    include_once("includes/variables.php");
    include_once("visitor.php");
    ?>
    <main>
        <section id="hero" class="bg-hero h-screen">
            <div class="w-full h-full backdrop-blur-sm flex items-center justify-center z-0">
                <div class="mx-auto text-gray text-5xl text-center font-nunito">
                    <h2>Alban</h2>
                    <h1>Développeur Web</h1>
                    <a href="#presentation"><button class="bg-navy text-gray text-xl p-2 rounded hover:bg-opacity-70 mt-4">Qui suis-je ?</button></a>
                </div>
            </div>
        </section>

        <section id="presentation" class="bg-blue text-gray py-7">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-center mb-5 text-3xl">Qui suis-je ?</h2>
                <div class="flex flex-col sm:flex-row space-y-5 sm:space-x-5">
                    <div class="flex items-center justify-center sm:max-w-[25rem] min-w-[15rem]">
                        <img src="images/photoLinkedin.png" alt="Alban Martinant de Préneuf" class="rounded-full w-fit">
                    </div>
                    <div class="flex flex-col items-center justify-center space-y-3 font-nunito text-lg">
                        <p>Hello, moi c'est Alban, Développeur Web en formation à LaPlateforme_, une école dont la pédagogie est basée sur les projets</p>
                        <p>Depuis de nombreuses années, je suis passioné par l'informatique et je me forme en autodidacte sur différentes technologies et langages de programmation.
                        <p>Après avoir obtenu mon diplôme de Développeur Web et Web Mobile (RNCP niveau Bac+2) l'année dernière, je souhaite trouver une entreprise pour une alternance de 2 ans pour continuer à apprendre et me perfectionner tout en préparent mon diplôme de Concepteur Développeur d'Applications (RNCP niveau Bac+3).</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="skills" class="bg-navy text-gray py-7">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-center mb-5 text-3xl">Compétences</h2>
                <div class="flex flex-row justify-between flex-grow">
                    <div>
                        <h3 class="mb-4 text-2xl">Langages</h3>
                        <ul class="space-y-3">
                            <li>HTML</li>
                            <li>CSS</li>
                            <li>JavaScript</li>
                            <li>PHP</li>
                            <li>SQL</li>
                            <li>Python</li>
                    </div>
                    <div>
                        <h3 class="mb-4 text-2xl">Frameworks</h3>
                        <ul class="space-y-3">
                            <li>Tailwind</li>
                            <li>React</li>
                            <li>Node.js</li>
                            <li>Express</li>
                            <li>Symfony</li>
                    </div>
                    <div>
                        <h3 class="mb-4 text-2xl">Autres</h3>
                        <ul class="space-y-3">
                            <li>Linux</li>
                            <li>Windows</li>
                            <li>Apache</li>
                            <li>MySQL</li>
                            <li>Git</li>
                            <li>GitHub</li>
                    </div>

                </div>
            </div>
        </section>

        <section id="certifs" class="bg-blue text-gray py-7">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-center mb-5 text-3xl">Certifications</h2>

                <div class="owl-carousel owl-theme">

                    <?php foreach ($certificats as $certificat => $image) : ?>

                        <div class="bg-teal rounded shadow-xl text-navy">
                            <div class="item">
                                <img class="rounded" src="<?= "images/Certificats/thumbnail/thumb." . $image ?>" alt="<?= $certificat ?>">
                            </div>
                            <h5 class="p-3 h-24"><?= $certificat ?></h5>
                            <button class="certif_btn bg-navy text-gray text-xl p-2 rounded-b hover:bg-opacity-70 mt-4 w-full" id="<?= $image ?>">
                                Voir le certificat
                            </button>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </section>

        <section id="contact" class="bg-navy text-gray py-7">
            <div class="max-w-6xl mx-auto px-5">
                <h2 class="text-center mb-5 text-3xl">Contact</h2>
                <form action="" method="POST" class="flex flex-col space-y-5" id="contact_form">
                    <p id="form-message"></p>
                    <div class="flex flex-col sm:flex-row sm:space-x-5">
                        <div class="flex flex-col space-y-3">
                            <label for="name">Nom</label>
                            <input type="text" name="name" id="name" class="rounded shadow-xl p-2 text-navy" required>
                        </div>
                        <div class="flex flex-col space-y-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="rounded shadow-xl p-2 text-navy" required>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="rounded shadow-xl p-2 text-navy" required></textarea>
                    </div>
                    <button type="submit" name="submit" class="bg-blue text-gray text-xl p-2 rounded hover:bg-opacity-70 mt-4 w-1/3 mx-auto">Envoyer</button>
            </div>
        </section>

    </main>

    <div id="modal" class=" hidden fixed z-40 top-0 left-0 w-full h-full bg-gray bg-opacity-50 flex-col items-center justify-center">
        <div class="relative h-full">
            <div class="max-w-[1000px] relative mt-[50vh] -translate-y-1/2">
                <i class="fa-solid fa-xmark absolute top-1 right-2 cursor-pointer text-3xl text-gray-600" id="close_btn"></i>
                <img src="" alt="" id="certif">
            </div>
        </div>
    </div>
</body>

</html>