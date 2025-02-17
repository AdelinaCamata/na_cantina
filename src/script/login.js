const CleanName = () => {
    let name = document.getElementById("name").value
    let cleanEmail = document.querySelector(".clean2")

    if (name.length  >= 1) {
        cleanEmail.classList.add("active")
    }else {
        cleanEmail.classList.remove("active")
    }
}


const emailVerification = () => {
    let email = document.getElementById("email").value
    let errorEmail = document.getElementById("errorEmail")
    let cleanEmail = document.querySelector(".clean")
    let paramentros = /^[^ ]+@[a-z]+\.[a-z]{2,3}$/

    if (email.length  >= 1) {
        cleanEmail.classList.add("active")
    }else {
        cleanEmail.classList.remove("active")
    }

    if (email.match(paramentros)) {
        errorEmail.innerText = ""
    }else {
        errorEmail.innerText = "Verifica seu Email ou preencha o campo vazio."
    }
}

const PassWordVerification = () => {
    let password = document.getElementById("password").value
    let errorPass = document.getElementById("errorPass")

    if (password.length  >= 8) {
        errorPass.innerText = ""
    }else {
        errorPass.innerText = "A senha não pode ter menos que 8 digitos."
    }
}

const Clean = () => {
    let email = document.getElementById("email").value = ""
}

const Clean2 = () => {
    let name = document.getElementById("name").value = ""
}

const ViewPassWord = document.querySelector(".ViewPassWord")

let view = false
ViewPassWord.onclick = () => {
    let password = document.getElementById("password")
    if(view){
        password.type = "password"
        view = false
    }else{
        password.type = "text"
        view = true
    }
}