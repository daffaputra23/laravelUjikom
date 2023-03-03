var toggleDark = document.querySelector('.toggleDark')
var html = document.querySelector('html')

toggleDark.addEventListener('click', function(){
    // html.classList.toggle('dark')
    toggleDark.checked ? html.classList.add('dark')
    : html.classList.remove('dark')
})

console.log(toggleDark)