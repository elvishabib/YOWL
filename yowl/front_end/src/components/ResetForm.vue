<template>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <div id="login" class="container mt-3">
        <div class="space-y-4">
            <span class="form-title">Reset your password</span>
            <div class="relative mt-3">
                <label for="email">Email</label>
                <input type="email" v-model='username' id="name" placeholder="username" required>
            </div>
            <div class="relative mt-4">
                <span class="half-form-control" id="day">
                    <button id="submit" class="half-form btn-gray text-gray" style="color: #555;">Cancel</button>
                </span>
                <span class="half-form-control" id="day">
                    <button id="submit" class="half-form btn-primary">Send Email</button>
                </span>
            </div>
            <div class="log-link">
                <span>
                    Already have an account ?
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>
