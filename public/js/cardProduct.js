
/* Untuk Element si Trending */
const cardProduct = () =>{
    let forYou = document.querySelector(".forYou");
    
    let anchor = document.createElement("a")
    anchor.href = "/SourceHTML/detailProduct.html"

    let card = document.createElement("div")
    card.className = "card test"
    
    card.innerHTML = `
    <p class="caption addOn">Air Force 1</p>
    <img class="catalog" src = "/SourceIMG/AirForce1-3.png" ></a>
    <p class="caption price ">Rp. 1.xxx.xxx</p>
    `;
    
    anchor.appendChild(card)
    forYou.appendChild(anchor)
}

for (let i = 0; i < 5; i++) {
    cardProduct()
}

// function show() {
//     window.location.href = "/SourceHTML/detailProduct.html"
// }