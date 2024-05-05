const tabs = document.querySelectorAll(".admin-menu-container .admin_tabs");

const content = document.querySelectorAll(".content-container .content");

const removeActiveClass = () => {
    tabs.forEach((t) => {
        t.classList.remove("active");
    });
    
    content.forEach((c) => {
        c.classList.remove("active");
    });
};


tabs.forEach((t, i)=> {
    t.addEventListener("click", () => {
        removeActiveClass();
        content[i].classList.add("active");
        t.classList.add("active");
    });
});