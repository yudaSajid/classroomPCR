document.addEventListener('livewire:load', function () {
    let countdownInterval;

    function startCountdown(duration, display) {
        let timer = duration, minutes, seconds;

        countdownInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(countdownInterval);
                display.textContent = "Waktu habis!";
                Livewire.emit('timerFinished');
            }
        }, 1000);
    }
});