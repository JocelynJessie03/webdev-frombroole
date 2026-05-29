<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>From Broole</title>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>

<body class="bg-[#f8f5f2] overflow-x-hidden">

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH C:\Users\Jessiee\Herd\frombroole\resources\views/layouts/app.blade.php ENDPATH**/ ?>