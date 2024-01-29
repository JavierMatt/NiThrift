const detail1 = document.querySelector(".detail-item")
const detail2 = document.querySelector(".detail-item-2")
const nextBtn = document.querySelector(`.grid`)
const image_input = document.querySelector("#photoProduct")

nextBtn.addEventListener("click", e => {
    detail1.style.display = "none"
    detail2.style.display = "block"
})

image_input.addEventListener("change", function() {
    const file_reader = new FileReader();
    file_reader.addEventListener("load", () => {
      const uploaded_image = file_reader.result;
      document.querySelector("#imgPreview").style.backgroundImage = `url(${uploaded_image})`;
    });
    file_reader.readAsDataURL(this.files[0]);
});