<?php

$seo_keywords = 'alexlostorto, Alex, Alex lo Storto, Alex Lo Storto, programmer, coder, web developer, open source, binary, mantissa, exponent, mantissas, floating point, binary point, floatig point binary, binary program, program';
$seo_description = 'Conquer mantissas and exponents!';
$seo_author = 'Alex lo Storto';
$site_title = 'Floating Point Binary';

include('components/header.php');

?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Jost&display=swap');

    * {
        font-family: 'Jost', sans-serif;
    }

    body {
        background-image: url('images/background.jpg');
        background-size: cover;
    }

    .floating-point-calculator {
        backdrop-filter: blur(10px);
        box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.5);
        padding: 1.5rem 2rem 0;
        border-radius: 2rem;
        min-width: 50vw;
        width: min-content;
        height: min-content;
    }

    .floating-point-calculator h1 {
        font-size: 4.5rem;
        padding-bottom: 1rem;
        animation: swipeDown 0.7s cubic-bezier(0, 0, 0.51, 1);
    }

    .floating-point-calculator span {
        font-size: 1.3rem;
    }

    @keyframes swipeDown {
        0% {
            transform: translateY(-30%);
            opacity: 0;
        }

        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<section class="floating-point-calculator d-flex flex-column align-items-center justify-content-center">
    <h1>Floating Point Binary</h1>

    <?php include('components/convert.php'); ?>
    <?php include('components/binary.php'); ?>
    <?php include('components/mantissa.php'); ?>
    <?php include('components/output.php'); ?>
</section>

<?php include('components/footer.php'); ?>
