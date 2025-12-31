let ucase = document.querySelector("#ucase")
let lcase = document.querySelector("#lcase")
let number = document.querySelector("#number")
let special_char = document.querySelector("#special_character")
let length = document.querySelector("#length")

const password_input = document.querySelector("#password");

password_input.addEventListener('input', () => {
    let password = password_input.value;
    let hasNumber = /\d/;
    let hasUCase = /[A-Z]/;
    let hasLCase = /[a-z]/;
    let hasSpecialChar = /[^a-zA-Z0-9]/;

    if(password.length>=8)
        length.classList.replace("not-met", "met");
    else
        length.classList.replace("met", "not-met");

    if(hasNumber.test(password))
        number.classList.replace("not-met", "met");
    else 
        number.classList.replace("met", "not-met");    


    if(hasUCase.test(password))
        ucase.classList.replace("not-met", "met");
    else
        ucase.classList.replace("met", "not-met");


    if(hasLCase.test(password))
        lcase.classList.replace("not-met", "met");
    else
        lcase.classList.replace("met", "not-met");


    if(hasSpecialChar.test(password))
        special_char.classList.replace("not-met", "met");
    else
        special_char.classList.replace("met", "not-met");

})