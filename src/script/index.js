let time = 6000
let local = "./src/pages/intro.php"

setInterval(() => {
    window.location.assign(`${local}`)
}, time)