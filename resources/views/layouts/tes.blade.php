<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar menu With Sub-menus | Using HTML, CSS & JQuery</title>
    @vite('resources/css/nav.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>

    <div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <header>
            <div class="close-btn">
                <i class="fas fa-times"></i>
            </div>
            <img src="https://lh3.googleusercontent.com/a-/AOh14Gj99VObFyE8W_h8RrcwZO_aYiIHu5AAa_XpnOym=s600-k-no-rp-mo"
                alt="">
            <h1>Mystery Code</h1>
        </header>
        <div class="menu">
            <div class="item"><a href="#"><i class="fas fa-desktop"></i>Dashboard</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-table"></i>Tables<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="#" class="sub-item">Sub Item 01</a>
                    <a href="#" class="sub-item">Sub Item 02</a>
                    <a href="#" class="sub-item">Sub Item 03</a>
                </div>
            </div>
            <div class="item"><a href="#"><i class="fas fa-th"></i>Forms</a></div>
            <div class="item">
                <a class="sub-btn"><i class="fas fa-cogs"></i>Settings<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="#" class="sub-item">Sub Item 01</a>
                    <a href="#" class="sub-item">Sub Item 02</a>
                </div>
            </div>
            <div class="item"><a href="#"><i class="fas fa-info-circle"></i>About</a></div>
        </div>
    </div>
    <section class="main">
        <h1>Sidebar Menu With<br>Sub-Menus</h1>
    </section>

    @vite('resources/js/nav.js')

</body>

</html>
