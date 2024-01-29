const list = document.getElementById("list")
const list2 = document.getElementById("list2")
const list3 = document.getElementById("list3")
const detailInfo = document.querySelector(".personalProfile-container")
const usrLoc = document.querySelector(".userLocation-container")
const changePass = document.querySelector(".changePass-container")
const image_input = document.querySelector("#photo");

// func untuk upload image
image_input.addEventListener("change", function() {
  const file_reader = new FileReader();
  file_reader.addEventListener("load", () => {
    const uploaded_image = file_reader.result;
    document.querySelector("#imagePreview").style.backgroundImage = `url(${uploaded_image})`;
  });
  file_reader.readAsDataURL(this.files[0]);
});


list.addEventListener("click",
    e => { 
    detailInfo.style.display = "flex";
    usrLoc.style.display = "none"
    changePass.style.display = "none"
    list.className = "list ul li::after"
    }
)

list2.addEventListener("click",
    e => { 
        detailInfo.style.display = "none"
        usrLoc.style.display = "block"
        changePass.style.display = "none"
    }
)

list3.addEventListener("click",
    e => { 
        detailInfo.style.display = "none"
        usrLoc.style.display = "none"
        changePass.style.display = "block"
    }
)

