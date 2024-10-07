function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    const menu_btn_close = document.querySelector('.menu_btn_close')
    sidebar.style.display = 'flex'
    menu_btn_close.style.visibility = 'hidden'
}
function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    const menu_btn_close = document.querySelector('.menu_btn_close')
    sidebar.style.display = 'none'
    menu_btn_close.style.visibility = 'visible'
}