function progress() {
    let progress = document.querySelector('.progress');
    let step = 0;
    let totalTime = 500; // 3 seconds in milliseconds
    let increment = totalTime / 200; // 200 steps
    let loading = setInterval(move, increment);

    function move() {
        if (step >= 50) {
            clearInterval(loading);
            document.location = "auth/login.php";
        } else {
            step++;
            progress.style.width = (step * 2) + 'px'; // Fix this line
        }
    }
}
progress();
