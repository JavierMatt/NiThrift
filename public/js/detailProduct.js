const success = document.querySelector(".success")
const failed = document.querySelector(".failed")
const waiting = document.querySelector(".waiting")
const btn = document.querySelector(".buy-btn")
const container = document.querySelector(".detailSeller")
const paymentInfo = document.querySelector(".paymentInfo")
const paid = document.querySelector(".paid-btn")
const paymentStatus = document.querySelector(".status")



// if (success) {
//     success.style.display = "block"
// } else if (failed) {
//     failed.style.display = "block"
// } else if (waiting) {
//     waiting.style.display = "block"
// }



btn.addEventListener("click", e => {
    container.style.display = "none"
    paymentInfo.style.display = "flex"
})

/* Ketika Button Padi di click stelah upload bukti */
paid.addEventListener("click", e => {

    paymentInfo.style.display = "none"
    if (success) {
        success.style.display = "block"
    } else if (failed) {
        failed.style.display = "block"
    } else if (waiting) {
        waiting.style.display = "block"
    }
})
