let time = 6000
let local = "./src/pages/intro.html"

setInterval(() => {
    window.location.assign(`${local}`)
}, time)