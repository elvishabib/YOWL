<template>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div class="col-auto d-inline">
        <div class="icon icon-shape bg-yellow-400 text-white text-lg rounded-circle">
            <i class="bi bi-person"></i>
        </div>
        <div class="name d-inline" style="display: inline; margin-left: 15px;">Elodie</div>
    </div>

    <h5 class="card-title">Your Title</h5>
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="../assets/logo.png" style="text-align: center;width: 120px;" class="card-img" alt="Your Image">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis, sunt? Aut, quo. Unde sit tempora
                    illum officiis nobis commodi veniam debitis reiciendis deserunt, asperiores consequuntur neque
                    corporis quam, eius velit.
                </p>
            </div>
            <div class="card-footer p-0">
                <button class="text-right">Your footer text</button>
            </div>
        </div>
        <div class="media-footer-wrapper">
            <div class="media-icons">
                <i class="fa fa-thumbs-o-up"></i>10
                <i class="fa fa fa-thumbs-o-up" style="transform: scale(-1); -webkit-transform: scale(-1);"></i>10
                <i class="fa fa-comment-o"></i>10
                <i class="fa fa-bookmark-o"></i>10
            </div>
        </div>
    </div>
</template>

<style>
.card-title {
    font-size: larger;
    font-weight: bold;
    color: #505050
}

.card-footer {
    position: absolute;
    right: 0;
    margin-right: 30px;
}

.media-icons .fa {
    font-size: larger;
    padding-left: 3px;
    padding-right: 3px;
    color: #0d67d1
}

.media-icons {
    display: block;
    margin-right: 10px;
}

.card-footer button {
    background: #0d67d1;
    color: #fff;
    border-radius: 5px;
    padding: 5px;
}</style>
