<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
            <div class="col-" style="width: 350px;">

                <div class="card1 p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="user d-flex flex-row align-items-center">

                            <img src="https://i.imgur.com/hczKIze.jpg" width="30px" style="width: 50px;" class="user-img rounded-circle mr-2">
                            <span><small class="font-weight-bold text-primary">{{ author }}</small> </span>

                        </div>

                        <small>{{ created_at }}</small>

                    </div>
                    <small class="font-weight-bold">{{ comment }}</small>
                    <div class="action d-flex justify-content-between mt-2 align-items-center">

                        <div class="icons align-items-center">

                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-check-circle-o check-icon"></i>

                        </div>

                    </div>

                </div>

            </div>
</template>
<script>
export default {
  props: {
    author: String,
    comment: String,
    created_at: String
  }
}
</script>

<style>
body {
    background-color: #f7f6f6
}

.card1 {

    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 4px;
}

.dots {

    height: 4px;
    width: 4px;
    margin-bottom: 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}

.badge {

    padding: 7px;
    padding-right: 9px;
    padding-left: 16px;
    box-shadow: 5px 6px 6px 2px #e9ecef;
}

.user-img {

    margin-top: 4px;
}

.check-icon {

    font-size: 17px;
    color: #c3bfbf;
    top: 1px;
    position: relative;
    margin-left: 3px;
}

.form-check-input {
    margin-top: 6px;
    margin-left: -24px !important;
    cursor: pointer;
}

.form-check-input:focus {
    box-shadow: none;
}

.icons i {

    margin-left: 8px;
}

.reply {

    margin-left: 12px;
}

.reply small {

    color: #b7b4b4;

}

.reply small:hover {

    color: green;
    cursor: pointer;

}
</style>
