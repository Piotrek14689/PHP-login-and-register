const button = document.querySelector("#theme-toggle");
        const mobile_button = document.querySelector("#theme-toggle-mobile");
        const html = document.querySelector("html");
        const savedTheme = localStorage.getItem("theme");

        if(savedTheme)
        {
            html.setAttribute("data-bs-theme", savedTheme);
            button.innerHTML = savedTheme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';
            mobile_button.innerHTML = savedTheme === 'dark' ? '☀️ Light Mode' : '🌙 Dark Mode';
        }
        


        button.addEventListener("click", () =>{
            let theme = html.getAttribute("data-bs-theme");
            if(theme === "dark")
            {
                button.innerHTML = "🌙 Dark Mode";
                html.setAttribute("data-bs-theme", "light");
                localStorage.setItem("theme", "light");
            }
            else if(theme === "light")
            {
                button.innerHTML = "☀️ Light Mode";
                html.setAttribute("data-bs-theme", "dark");
                localStorage.setItem("theme", "dark");
            }    

        })
        mobile_button.addEventListener("click", () =>{
            let theme = html.getAttribute("data-bs-theme");
            if(theme === "dark")
            {
                mobile_button.innerHTML = "🌙 Dark Mode";
                html.setAttribute("data-bs-theme", "light");
                localStorage.setItem("theme", "light");
            }
            else if(theme === "light")
            {
                mobile_button.innerHTML = "☀️ Light Mode";
                html.setAttribute("data-bs-theme", "dark");
                localStorage.setItem("theme", "dark");
            }    

        })