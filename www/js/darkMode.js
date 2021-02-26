document.querySelector("#darkMode").addEventListener("click",()=>{
    document.querySelector("body").classList.toggle("dark");
    let ajax = new XMLHttpRequest();
    var xmlhttp = new XMLHttpRequest();
    ajax.open("GET", "toggleDarkMode.php", true);
    ajax.send();
});

