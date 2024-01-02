let first_page = document.getElementsByClassName('main-page')[0];

let navBar_heigth = navBar.offsetHeight;
first_page.style.paddingTop = `${navBar_heigth}px`;

window.addEventListener('resize', () => {
    let navBar_heigth = navBar.offsetHeight;
    first_page.removeAttribute('style');
    first_page.style.paddingTop = `${navBar_heigth}px`;
})