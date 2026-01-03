const ucase = document.querySelector("#ucase")
const lcase = document.querySelector("#lcase")
const number = document.querySelector("#number")
const special_char = document.querySelector("#special_character")
const length = document.querySelector("#length")

const password_input = document.querySelector("#password");
const login_input = document.querySelector("#login");
const confirm_password = document.querySelector("#confirm_password");
const submit = document.querySelector("#submit");

login_input.addEventListener("input", () => {
    login_input.value = login_input.value.trim();
})
confirm_password.addEventListener("input", () => {
    confirm_password.value = confirm_password.value.trim();
})

password_input.addEventListener('input', () => {
    password_input.value = password_input.value.trim();
    let password = password_input.value;
    let hasNumber = /\d/;
    let hasUCase = /[A-Z]/;
    let hasLCase = /[a-z]/;
    let hasSpecialChar = /[^a-zA-Z0-9\s]/;

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


    submit.disabled = !(password.length >= 8 && hasNumber.test(password) && hasUCase.test(password) && hasLCase.test(password) && hasSpecialChar.test(password));

})

