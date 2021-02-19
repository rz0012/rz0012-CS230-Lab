<?php
require 'includes/header.php';
?>

<main>

    <link rel="stylesheet" href="css/login.css">

    <div class="bg-cover">
        <div class="container">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block" src="images/login_img1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="images/login_img2.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="images/login_img3.jpg" alt="Third slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="images/login_img4.jpg" alt="Fourth slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block" src="images/login_img5.jpg" alt="Fifth slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
        </div>

        <div class="h-40 center-me">
            <div class="my-auto">
                <form class="login-form" action="includes/login-helper.php" method="post">

                    <h1 class="h3 mb-3 fw-normal">Please Log in</h1>

                    <p class="hint-text"> Enter into your account! </p>

                    <div class="form-group">
                        <input type="text" class="form-control" name="uname" placeholder="User Name"
                            required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email"
                            required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-outline-success btn-block" name="Login-submit" type="submit">Log
                            in
                        </button>
                    </div>

                </form>



            </div>
        </div>
    </div>

</main>