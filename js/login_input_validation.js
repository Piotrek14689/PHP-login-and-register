const password_input = document.querySelector("#password");
const login_input = document.querySelector("#login");

login_input.addEventListener("input", () => {
    login_input.value = login_input.value.trim();
})

password_input.addEventListener("input", () => {
    password_input.value = password_input.value.trim();
})