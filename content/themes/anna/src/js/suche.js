const input = document.getElementById('input');
const title = document.querySelectorAll('.titel')

input.addEventListener('keyup', e => { 
    
    let suchWert = e.target.value.toLowerCase();
    console.log(suchWert)

    title.forEach(t => {
        console.log(t.parentNode)
        if(t.innerText.toLowerCase().includes(suchWert) ) {
            t.parentElement.style.display = "block"
        } else {
            t.parentElement.style.display= "none"
        }
    });
})