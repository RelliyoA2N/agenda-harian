function getTodayDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, "0");
    const day = String(today.getDate()).padStart(2, "0");
    return year + "-" + month + "-" + day;
}

function getCurrentTime() {
    const now = new Date();
    const hour = String(now.getHours()).padStart(2, "0");
    const minute = String(now.getMinutes()).padStart(2, "0");
    return hour + ":" + minute;
}

document.addEventListener("DOMContentLoaded", function () {
    const inputTanggal = document.getElementById("tanggal");
    const inputJam = document.getElementById("jam");

    if (inputTanggal && !inputTanggal.value) {
        inputTanggal.value = getTodayDate();
    }

    if (inputJam && !inputJam.value) {
        inputJam.value = getCurrentTime();
    }
});
