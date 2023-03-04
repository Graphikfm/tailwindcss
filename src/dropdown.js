
function toggleDropDown(el) {
    el.classList.toggle("hidden");
}

document.addEventListener("click", function(e){
    let dropdown = document.querySelector('.dropDownList');
    let contDropDown = document.querySelector('.dropdownContainer')
    // la fonction toggle est utilisée que si on clique sur contDropDown
    if(e.target === contDropDown){
        // console.log(e.target);
        toggleDropDown(dropdown);
        // sinon on ajoute la classe 'hidden à dropdown
    } else {
        dropdown.classList.add('hidden')
        // console.log('toto')
    }
})


// document.addEventListener("click", function(e){
//     let dropdown = document.querySelector('.dropDownList');
//     let body = document.querySelector('.body');
//     if(e.target !== body){
//         // console.log(e.target);
//         toggleDropDown(dropdown);
//     } else dropdown.classList.add('hidden')
// })

// function mousePosition(e) {
//     let x = e.clientX;
//     let y = e.clientY;
//     console.log(x,y);
// }

// const body = document.querySelector('.body');
// body.addEventListener('click', (e)=>{
//     const targetList = document.querySelector('.dropDownList');
//     let x = e.clientX;
//     let y = e.clientY;
//     console.log(x,y);
//     if(!targetList.classList.contains('hidden')) {
//         if (((x <= 710) || (y <= 156)) || ((x >=1211) || (y >= 479))) {
//             targetList.classList.add('hidden');
//         }
//     }
// })


// closeDropDown.addEventListener('click',()=>{
//     const targetList = document.querySelector('.dropDownList');
//     if(targetList.classList.contains('tp') && targetList.classList.contains('hidden')) {
//         targetList.classList.remove('tp');
//         console.log('coucou');
//         targetList.classList.add('hidden');
//     } else targetList.classList.remove('hidden');
//     console.log('loupé');
//
// });
