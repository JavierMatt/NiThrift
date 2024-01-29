
/* ---- UNTUK MEN & WOMEN RECOMMENDATION ---- */
const container = document.querySelector(".women-container")
const menContainer = document.querySelector(".men-container")


function fill(destination) {
    /* anchor ini supaya ketika catalogProduct di klik akan menuju ke halaman dtailProduct */
    let anchor = document.createElement("a")
    // anchor.href = "/resources/views/detailProduct.blade.php"
    anchor.href = "/detail"

    const card = document.createElement('div')
    card.className = "card test"

    /*  ini array untuk randomIMG */
    // let imageUrls = [
    //     "/SourceIMG/AirForce1-2.png",
    //     "/SourceIMG/AirForce1-3.png",
    //     "/SourceIMG/AirForce1-4.png"
    // ];

    // // Memilih URL gambar secara acak dari daftar imageUrls
    // let randomImageUrl = imageUrls[Math.floor(Math.random() * imageUrls.length)];
    
    card.innerHTML = `
    <div class="caption addOn">Air Force 1 - Low</div>
    <img class="catalog" src = "/SourceIMG/AirForce1-3.png" >
    <div class="caption price ">Rp. 1.xxx.xxx</div>
    `;

    /* Assign si div catalog ke dalam <a href > yg tadi dibuat */
    anchor.appendChild(card)
    destination.appendChild(anchor)
}

for (let i = 0; i < 10; i++) {
    fill(container)
}

for (let i = 0; i < 10; i++) {
    fill(menContainer)
}

/* ---- INI UNTUK CARD CARD TRENDING PRODUCT ----  */

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  let pageNumber = document.getElementsByClassName("test");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
    pageNumber[i].innerHTML = "Product " + slideIndex;
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 4000); // Change image every 2 seconds

//   for (i = 0; i < dots.length; i++) {
//     dots[i].className = dots[i].className.replace(" active", "");
//   }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";

} 

