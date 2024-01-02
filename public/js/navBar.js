const navBar = document.getElementById('navBar')
const logo_item = document.getElementById('logo')
const user_item = document.getElementById('user')
const menu_item = document.getElementById('menu')
const menu_conatiner = document.getElementById('mainMenu-container')
const userMenu_conatiner = document.getElementById('userMenu-container');
var menu_switch = false;
var user_switch = false;

let navBarHeigth = navBar.offsetHeight;
let menuContainerHeigth = menu_conatiner.offsetHeight;
let userMenuConatinerWidth = userMenu_conatiner.offsetWidth;
menu_conatiner.style.top = `-${navBarHeigth + menuContainerHeigth}px`;
userMenu_conatiner.style.top = `${navBarHeigth}px`;
userMenu_conatiner.style.right = `-${userMenuConatinerWidth}px`;


logo_item.addEventListener('click', () => {
    document.location.href = "/";
})

window.addEventListener('resize', () =>{
    let navBar = document.getElementById('navBar')
    let navBarHeigth = navBar.offsetHeight;
    let menuContainerHeigth = menu_conatiner.offsetHeight;
    let userMenuConatinerWidth = userMenu_conatiner.offsetWidth;
    menu_conatiner.style.top = `-${navBarHeigth + menuContainerHeigth}px`;
    userMenu_conatiner.style.top = `${navBarHeigth}px`;
    //userMenu_conatiner.style.right = `-${userMenuConatinerWidth}px`;
})

menu_item.addEventListener('click', handle_mainMenu)

user_item.addEventListener('click', handle_userMenu)

const page = document.getElementsByClassName('main-page')[0];
page.addEventListener('click', () => {
    if(menu_switch) handle_mainMenu();
    if(user_switch) handle_userMenu();

})

function handle_mainMenu(){
    handle_colision_menu("main");
    menu_switch = !menu_switch;
    let menuContainerHeigth = menu_conatiner.offsetHeight;
    let navBarHeigth = navBar.offsetHeight;
    if(menu_switch){
        menu_conatiner.style.transform = `translate(0, ${menuContainerHeigth + navBarHeigth + navBarHeigth}px)`
    }else{
        menu_conatiner.style.transform = `translate(0, -${menuContainerHeigth + navBarHeigth}px)`
    }
}

function handle_userMenu(){
    handle_colision_menu("user");
    user_switch = !user_switch
    if(user_switch){
        userMenu_conatiner.style.right = "0px";
    }else{
        userMenu_conatiner.style.right = `-${userMenuConatinerWidth}px`;
    }
}

function handle_colision_menu(menu){
    if(menu == "user" && menu_switch){
        handle_mainMenu()
    }else if(menu == "main" && user_switch){
        handle_userMenu()
    }
}