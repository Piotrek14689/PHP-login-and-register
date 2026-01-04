const password_input = document.querySelector("#password");
const login_input = document.querySelector("#login");
const confirm_password = document.querySelector("#confirm_password");
const submit = document.querySelector("#submit");

const pwRuleLength = document.querySelector("#pwRuleLength");
const pwRuleUpper = document.querySelector("#pwRuleUpper");
const pwRuleLower = document.querySelector("#pwRuleLower");
const pwRuleNumber = document.querySelector("#pwRuleNumber");
const pwRuleSpecial = document.querySelector("#pwRuleSpecial");

function validateLogin(login) {

    const isAlnum = /^[a-zA-Z0-9]+$/.test(login);

    if (login.length === 0) {
        login_input.classList.remove("is-invalid", "is-valid");
        return false;
    }

    if (isAlnum) {
        login_input.classList.remove("is-invalid");
        login_input.classList.add("is-valid");
    } else {
        login_input.classList.remove("is-valid");
        login_input.classList.add("is-invalid");
    }

    return isAlnum;
}

function validatePasswordRules(password) {
    const hasNumber = /\d/;
    const hasUCase = /[A-Z]/;
    const hasLCase = /[a-z]/;
    const hasSpecialChar = /[^a-zA-Z0-9\s]/;

    const okLength = password.length >= 8;
    const okUpper = hasUCase.test(password);
    const okLower = hasLCase.test(password);
    const okNumber = hasNumber.test(password);
    const okSpecial = hasSpecialChar.test(password);

    pwRuleLength.classList.toggle("text-success", okLength);
    pwRuleLength.classList.toggle("text-danger", !okLength);

    pwRuleUpper.classList.toggle("text-success", okUpper);
    pwRuleUpper.classList.toggle("text-danger", !okUpper);

    pwRuleLower.classList.toggle("text-success", okLower);
    pwRuleLower.classList.toggle("text-danger", !okLower);

    pwRuleNumber.classList.toggle("text-success", okNumber);
    pwRuleNumber.classList.toggle("text-danger", !okNumber);

    pwRuleSpecial.classList.toggle("text-success", okSpecial);
    pwRuleSpecial.classList.toggle("text-danger", !okSpecial);

    const isValid = okLength && okUpper && okLower && okNumber && okSpecial;

    if (password.length === 0) {
        password_input.classList.remove("is-invalid", "is-valid");
        return false;
    }

    if (isValid) {
        password_input.classList.remove("is-invalid");
        password_input.classList.add("is-valid");
    } else {
        password_input.classList.remove("is-valid");
        password_input.classList.add("is-invalid");
    }

    return isValid;
}

function validateConfirmPassword() {
    const pass = password_input.value;
    const confirm = confirm_password.value;

    if (confirm.length === 0) {
        confirm_password.classList.remove("is-invalid", "is-valid");
        return false;
    }

    const matches = pass === confirm;
    if (matches) {
        confirm_password.classList.remove("is-invalid");
        confirm_password.classList.add("is-valid");
    } else {
        confirm_password.classList.remove("is-valid");
        confirm_password.classList.add("is-invalid");
    }

    return matches;
}

function validateForm() {
    const loginOk = validateLogin(login_input.value);
    const passwordOk = validatePasswordRules(password_input.value);
    const confirmOk = validateConfirmPassword();
    submit.disabled = !(loginOk && passwordOk && confirmOk);
}

login_input.addEventListener("input", () => {
    login_input.value = login_input.value.trim();
    validateForm();
});

password_input.addEventListener("input", () => {
    password_input.value = password_input.value.trim();
    validateForm();
});

confirm_password.addEventListener("input", () => {
    confirm_password.value = confirm_password.value.trim();
    validateForm();
});

validateForm();
